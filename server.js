const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);

app.use(express.static('.'));

const users = {};

io.on('connection', socket => {
  users[socket.id] = socket;

  // Сообщить новому пользователю про остальных
  socket.emit("all-users", Object.keys(users).filter(id => id !== socket.id));

  // Уведомить других, что кто-то зашел
  socket.broadcast.emit("user-joined", socket.id);

  // Обработка сигналов WebRTC
  socket.on("signal", ({ to, signal }) => {
    if (users[to]) {
      users[to].emit("signal", { from: socket.id, signal });
    }
  });

  // Удалить пользователя при выходе
  socket.on("disconnect", () => {
    delete users[socket.id];
    io.emit("user-left", socket.id);
  });

  socket.on("join", () => {}); // на будущее
});

http.listen(3000, () => {
  console.log('Сервер запущен на http://localhost:3000');
});
