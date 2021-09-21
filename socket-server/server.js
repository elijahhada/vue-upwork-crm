const path = require('path');
const http = require('http');
const express = require('express');
const cors = require('cors');
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('job-delete');
redis.on('message', function (channel, message) {
    console.log('Message receved: '+ message)
    console.log('Channel: '+ channel)
    message = JSON.parse(message)
    io.emit(channel + ':' +message.event, message.data)
})

const app = express();
const server = http.createServer(app);
const httpio = http.Server();
const io = require('socket.io')(httpio);

app.use(express.static(path.join(__dirname, 'public')));
const bodyParser = require('body-parser');
app.use(bodyParser.json());
app.use(cors());

const PORT = 3000 || process.env.PORT;

server.listen(PORT, console.log(`Сервер запущен по порту ${PORT}`));

io.on('connection', socket => {
    console.log("Начало положено");
    socket.on('test', (message) => {
        io.emit('message', 'SPACITY, YA DOLZHEN OTPRAVIT SOOBSHENIE');
    });
    socket.on('jobEvent', ({id, action}) => {
        console.log('Данные отправлены');
        io.emit('jobEventMessage', {id, action});
    })
    socket.on('disconnect', (socket) => {
        console.log("Отключился")
    })
});
