// const HOST = 'https://localhost';
// const PORT = 3000;
// const hostname = `${HOST}:${PORT}`;
//
// const express = require('express');
// const app = express();
// const server = require('http').createServer(app);
//
// const io = require('socket.io')(server, {
//     cors: { origin: '*' },
// });
const path = require('path')
const http = require('https')
const express = require('express')
const cors = require('cors')

const app = express()
const server = http.createServer(app)
const io = require('socket.io')(server, {
    cors: { origin: '*' },
})

app.use(express.static(path.join(__dirname, 'public')))
const bodyParser = require('body-parser')
app.use(bodyParser.json())
app.use(cors())
const PORT = 3000 || process.env.PORT

io.on('connection', (socket) => {
    socket.connected && console.log(`→ Socket connected`);

    socket
        .on('job:speak', (data) => {
            console.log('job:speak', data);
            socket.broadcast.emit('job:listeners', data);
        })
        .on('calendar:speak', (data) => {
            console.log('calendar:speak', data);
            socket.broadcast.emit('calendar:listeners', data);
        })
        .on('kits:speak', (data) => {
            console.log('kits:speak', data);
            socket.broadcast.emit('kits:listeners', data);
        })
        .on('disconnect', () => {
            console.log(`← Socket disconnect`);
        });
});

server.listen(PORT, () => {
    console.log(`WS Server running on ${PORT}\n`);
});
