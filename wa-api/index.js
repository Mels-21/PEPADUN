const { Client, LocalAuth } = require('whatsapp-web.js');
const qrcodeTerminal = require('qrcode-terminal');
const qrcodeImg = require('qrcode');
const express = require('express');

const app = express();
app.use(express.json()); // Allow JSON body parsing

// Initialize WhatsApp Client
// LocalAuth saves session so you don't need to scan QR code on every restart
const client = new Client({
    authStrategy: new LocalAuth(),
    puppeteer: { 
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage', '--disable-gpu']
    }
});

let currentQrData = '';
let isReady = false;

// Event when QR code needs to be scanned
client.on('qr', (qr) => {
    currentQrData = qr;
    console.log('\n=========================================');
    console.log('SCAN THIS QR CODE WITH YOUR WHATSAPP');
    console.log('OR VISIT: https://<your-railway-domain>/qr');
    console.log('=========================================\n');
    qrcodeTerminal.generate(qr, { small: true });
});

// Event when successfully authenticated
client.on('ready', () => {
    isReady = true;
    console.log('WhatsApp Client is ready!');
});

// Start initialization
client.initialize();

// ==========================================
// API ENDPOINT FOR QR CODE SCANNING (WEB)
// ==========================================
app.get('/qr', async (req, res) => {
    if (isReady) {
        return res.send('<h2 style="text-align:center; margin-top:20%">✅ WhatsApp is already connected and ready!</h2>');
    }
    if (!currentQrData) {
        return res.send('<h2 style="text-align:center; margin-top:20%">⏳ Please wait, generating QR code... Refresh this page in a few seconds.</h2>');
    }
    try {
        const qrImageBase64 = await qrcodeImg.toDataURL(currentQrData);
        res.send(`
            <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100vh; font-family:sans-serif;">
                <h2>Scan this QR Code with WhatsApp</h2>
                <img src="${qrImageBase64}" alt="QR Code" style="width:300px; height:300px; border:2px solid #ccc; border-radius:10px; padding:10px;" />
                <p>Refresh this page if the code expires.</p>
            </div>
        `);
    } catch (err) {
        res.status(500).send('Error generating QR code image');
    }
});

// ==========================================
// API ENDPOINT FOR CODEIGNITER TO CALL
// ==========================================
app.post('/send-message', async (req, res) => {
    try {
        const number = req.body.number; // Target number
        const message = req.body.message; // Message content

        if (!number || !message) {
            return res.status(400).json({ status: false, message: 'Number and message are required' });
        }

        // Format number to standard WhatsApp format (append @c.us)
        let formattedNumber = number;
        // Convert starting 0 to 62
        if (formattedNumber.startsWith('0')) {
            formattedNumber = '62' + formattedNumber.substring(1);
        }
        // Remove spaces or dashes if any
        formattedNumber = formattedNumber.replace(/[\s-]/g, '');
        
        const chatId = formattedNumber + '@c.us';

        // Send the message
        await client.sendMessage(chatId, message);
        
        console.log(`Message successfully sent to ${number}`);
        res.json({ status: true, message: 'Pesan berhasil dikirim' });
    } catch (error) {
        console.error('Error sending message:', error);
        res.status(500).json({ status: false, message: 'Gagal mengirim pesan', error: error.toString() });
    }
});

// Start the Express server
const PORT = process.env.PORT || 3000;
app.listen(PORT, '0.0.0.0', () => {
    console.log(`\n=========================================`);
    console.log(`Local WhatsApp API Server is running on http://localhost:${PORT}`);
    console.log(`=========================================\n`);
});
