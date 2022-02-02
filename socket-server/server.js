const HOST = 'https://upwork.vasterra.com';
const PORT = 3000;
const hostname = `${HOST}:${PORT}`;

const fs = require('fs');
const https = require('https');
// .globalAgent.options.rejectUnauthorized = false;
const express = require('express');
const app = express();

const options = {
    key: fs.readFileSync('../ssl/file.pem'),
    cert: fs.readFileSync('../ssl/csr.pem')
}
const server = https.createServer(options, app);

const io = require('socket.io')(server, {
    cors: { origin: '*' },
}).listen(PORT);

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

server.listen(PORT, 'https://upwork.vasterra.com', () => {
    console.log(`WS Server running on ${hostname}\n`);
});
