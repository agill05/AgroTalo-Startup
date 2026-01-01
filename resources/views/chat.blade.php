@extends('layouts.app')

@section('title', 'Hubungi Kami - AgroTalo')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .chat-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding: 1rem;
    }

    .chat-header {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 1.25rem;
        padding: 1.25rem 1.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo-wrapper {
        position: relative;
    }

    .logo-wrapper img {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        transition: transform 0.3s ease;
    }

    .logo-wrapper img:hover {
        transform: scale(1.05);
    }

    .status-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        background: #10b981;
        border: 2px solid white;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .header-info h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #065f46;
        margin-bottom: 0.125rem;
    }

    .header-info p {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
    }

    .back-btn {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border: none;
        padding: 0.75rem 1.25rem;
        border-radius: 0.75rem;
        color: #374151;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .back-btn:hover {
        background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .back-btn svg {
        transition: transform 0.3s ease;
    }

    .back-btn:hover svg {
        transform: translateX(-3px);
    }

    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 1.25rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        min-height: 70vh;
    }

    .n8n-chat-wrapper {
        width: 100%;
        height: 100%;
        min-height: 70vh;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .welcome-screen {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 253, 244, 0.95) 100%);
        z-index: 10;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .welcome-screen.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .welcome-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        animation: wave 2s ease-in-out infinite;
    }

    @keyframes wave {
        0%, 100% {
            transform: rotate(0deg);
        }
        25% {
            transform: rotate(20deg);
        }
        75% {
            transform: rotate(-20deg);
        }
    }

    .welcome-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #065f46;
        margin-bottom: 0.75rem;
        text-align: center;
    }

    .welcome-content p {
        font-size: 1.125rem;
        color: #6b7280;
        text-align: center;
        max-width: 600px;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        max-width: 800px;
        width: 100%;
        margin-top: 1rem;
    }

    .quick-action-btn {
        background: white;
        border: 2px solid #e5e7eb;
        padding: 1.25rem;
        border-radius: 1rem;
        color: #374151;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: left;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .quick-action-btn:hover {
        border-color: #10b981;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        color: #065f46;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.15);
    }

    .quick-action-btn .icon {
        font-size: 1.75rem;
        flex-shrink: 0;
    }

    .quick-action-btn .text {
        flex: 1;
    }

    .quick-action-btn .text h3 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: inherit;
    }

    .quick-action-btn .text p {
        font-size: 0.875rem;
        color: #9ca3af;
        margin: 0;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
        max-width: 800px;
        width: 100%;
    }

    .feature-card {
        background: white;
        padding: 1.25rem;
        border-radius: 0.875rem;
        text-align: center;
        border: 2px solid #f3f4f6;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        border-color: #10b981;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
    }

    .feature-card .icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .feature-card h4 {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
    }

    @media (max-width: 768px) {
        .chat-wrapper {
            padding: 0.5rem;
        }

        .chat-header {
            padding: 1rem;
            border-radius: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-left {
            flex: 1;
        }

        .header-info h1 {
            font-size: 1.25rem;
        }

        .header-info p {
            font-size: 0.75rem;
        }

        .logo-wrapper img {
            width: 40px;
            height: 40px;
        }

        .back-btn {
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
        }

        .chat-main {
            border-radius: 1rem;
            min-height: 65vh;
        }

        .welcome-content h2 {
            font-size: 1.5rem;
        }

        .welcome-content p {
            font-size: 1rem;
        }

        .welcome-icon {
            font-size: 3rem;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }

        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="chat-wrapper">
    <!-- Header -->
    <div class="chat-header">
        <div class="header-left">
            <div class="logo-wrapper">
                <img src="https://cdn-icons-png.flaticon.com/512/12529/12529348.png" alt="AgroTalo Logo">
                <div class="status-indicator"></div>
            </div>
            <div class="header-info">
                <h1>AgroTalo Assistant</h1>
                <p>🤖 AI Siap Membantu Anda</p>
            </div>
        </div>
        <a href="{{ route('home') }}" class="back-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Chat Main -->
    <div class="chat-main">
        <div id="n8n-chat-wrapper" class="n8n-chat-wrapper">
            <!-- Welcome Screen -->
            
        </div>
    </div>
</div>

<!-- n8n Chat Scripts -->
<link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />
<script type="module">
    import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

    let chatInstance = null;
    let isInitialized = false;

    document.addEventListener('DOMContentLoaded', function() {
        initializeChat();
    });

    function initializeChat() {
        if (isInitialized) return;

        chatInstance = createChat({
            webhookUrl: 'https://sorai.app.n8n.cloud/webhook/de9b8dbb-7b77-4c8c-a7e8-03f6ffbe217f/chat',
            target: '#n8n-chat-wrapper',
            mode: 'fullscreen',
            title: '',
            subtitle: '',
            initialMessages: [
                'Halo! Selamat datang di AgroTalo. 🌱',
                'Saya bisa bantu cek harga benih, pupuk, atau obat pertanian. Mau cari apa hari ini?'
            ],
            i18n: {
                en: {
                    title: '',
                    subtitle: '',
                    inputPlaceholder: 'Ketik pertanyaan Anda...',
                    getStarted: 'Mulai Chat',
                },
            },
            onReady: function() {
                console.log('Chat initialized successfully');
                isInitialized = true;
            },
            onError: function(error) {
                console.error('Chat initialization error:', error);
            }
        });
    }

    window.startChatWithMessage = function(message) {
        const welcomeScreen = document.getElementById('welcome-screen');
        welcomeScreen.classList.add('hidden');

        if (!isInitialized) {
            initializeChat();
            setTimeout(() => {
                sendMessage(message);
            }, 1500);
        } else {
            sendMessage(message);
        }
    };

    function sendMessage(message) {
        try {
            if (chatInstance && typeof chatInstance.sendMessage === 'function') {
                chatInstance.sendMessage(message);
            } else {
                const inputField = document.querySelector('.chat-input, input[type="text"], textarea');
                const sendButton = document.querySelector('.send-btn, button[type="submit"]');
                if (inputField && sendButton) {
                    inputField.value = message;
                    inputField.dispatchEvent(new Event('input', { bubbles: true }));
                    setTimeout(() => sendButton.click(), 100);
                }
            }
        } catch (error) {
            console.error('Error sending message:', error);
        }
    }
</script>
@endsection