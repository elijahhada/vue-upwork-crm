const { readFileSync } = require('fs');
const { join } = require('path');

const http = require('http');
const https = require('https');

const httpPort = 444;
const httpsPort = 443;

const httpServer = http.createServer();
const httpsServer = https.createServer({
    key: readFileSync(join(__dirname, '..', 'ssl', 'key.pem')),
    cert: readFileSync(join(__dirname, '..', 'ssl', 'csr.pem')),
    ca: readFileSync(join(__dirname, '..', 'ssl', 'ca.pem')),
    requestCert: false,
    rejectUnauthorized: false,
});

httpServer.listen(httpPort, function () {
    console.log(`Listening HTTP on ${httpPort}`);
});

httpsServer.listen(httpsPort, function () {
    console.log(`Listening HTTPS on ${httpsPort}`);
});

[httpServer, httpsServer].forEach((server) => {
    const io = require('socket.io')(server, {
        cors: { origin: '*' },
    });

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
});
