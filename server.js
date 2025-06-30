const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);

app.use(express.static('.')); // Статичные файлы (index.html)

const users = {};

io.on('connection', socket => {
  users[socket.id] = socket;

  socket.broadcast.emit("user-joined", socket.id);

  socket.on("signal", data => {
    const to = data.to;
    const signal = data.signal;
    if (users[to]) {
      users[to].emit("signal", { from: socket.id, signal });
    }
  });

  socket.on('disconnect', () => {
    delete users[socket.id];
    io.emit("user-left", socket.id);
  });

  socket.on("join", () => {
    // Просто подтверждение входа
  });
});

http.listen(3000, () => {
  console.log('Сервер запущен на http://localhost:3000');
});