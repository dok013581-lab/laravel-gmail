<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskManager - Đăng nhập</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

       body {
    	margin: 0;
    	min-height: 100vh;
    	font-family: Arial, sans-serif;

    	background-image: url('/images/login-bg.png');
   	 background-size: cover;
   	 background-position: center;
    	background-repeat: no-repeat;

    	display: flex;
    	align-items: center;
    	justify-content: flex-end;

    	padding: 40px 45px 40px 40px;
}

        .login-card {
  	  width: 460px;
    	min-height: 560px;

    	background: rgba(255, 255, 255, 0.97);

   	 padding: 55px 50px;
    	border-radius: 24px;
	
    	box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);

    	display: flex;
   	 flex-direction: column;
    	justify-content: center;
	}

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

       .logo h1 {
    		margin: 0;
    		color: #111827;
    		font-size: 30px;
	}
	.task-text {
   	 color: #111827;
	}

	.manager-text {
   	 color: #2563eb;
	}

        .logo p {
            margin-top: 8px;
            color: #777;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 10px;
        }
	.logo-icon {
    width: 55px;
    height: 55px;

    margin: 0 auto 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #2563eb;
    color: white;

    border-radius: 14px;

    font-size: 24px;

    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
}

        .description {
            text-align: center;
            color: #777;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .google-btn {
   		width: 100%;
   		 display: flex;
    		align-items: center;
    		justify-content: center;
    		gap: 12px;

   		 padding: 14px;

   		 background: #2563eb;
    		color: white;

    		border: 1px solid #2563eb;
    		border-radius: 10px;

    		font-size: 16px;
    		font-weight: bold;

    		text-decoration: none;

    		transition: all 0.25s ease;
	}

        .google-btn {
   	 width: 100%;
   	 height: 52px;

   	 position: relative;

   	 display: flex;
   	 align-items: center;
    	justify-content: center;

    	padding: 0 20px;

    	background: #2563eb;
    	color: white;

    	border: 1px solid #2563eb;
   	 border-radius: 10px;

    	font-size: 16px;
    	font-weight: bold;

    	text-decoration: none;

    	transition: all 0.25s ease;
	}

	.google-btn:hover {
   	 background: #1d4ed8;
    	border-color: #1d4ed8;
    	box-shadow: 0 6px 18px rgba(37, 99, 235, 0.25);
    	transform: translateY(-2px);
	}

        .google-icon {
    	width: 20px;
   	 height: 20px;
	}

        .google-icon-circle {
            width: 36px;
            height: 36px;

            background: white;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            position: absolute;
            left: 8px;
        }

        .security {
            margin-top: 25px;
            padding: 12px;

            background: #f0f7ff;
            border-radius: 8px;

            text-align: center;
            font-size: 13px;
            color: #555;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        @media (max-width: 800px) {
            body {
                justify-content: center;
                padding: 20px;
            }

            .login-card {
                width: 100%;
                max-width: 400px;
            }
        }

        /* TOAST NOTIFICATION */
        .toast-container {
            position: fixed;
            top: 25px;
            right: 25px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            max-width: 420px;
            padding: 14px 18px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            border-left: 5px solid #10b981;
            animation: slideIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            transition: all 0.3s ease;
        }

        .toast.toast-error {
            border-left-color: #ef4444;
        }

        .toast.toast-error .toast-icon {
            color: #ef4444;
        }

        .toast-icon {
            font-size: 20px;
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-content {
            flex: 1;
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
        }

        .toast-close {
            background: transparent;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: 14px;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-close:hover {
            color: #374151;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(100%); }
        }
    </style>
</head>

<body>

    @if(session('error'))
        <div class="toast-container" id="toastContainer">
            <div class="toast toast-error">
                <div class="toast-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="toast-content">
                    {{ session('error') }}
                </div>
                <button type="button" class="toast-close" onclick="closeToast(this)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
        <script>
            function closeToast(btn) {
                const toast = btn.closest('.toast');
                toast.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => toast.remove(), 300);
            }
            setTimeout(() => {
                const toast = document.querySelector('.toast');
                if (toast) {
                    toast.style.animation = 'fadeOut 0.3s forwards';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 4000);
        </script>
    @elseif(session('success'))
        <div class="toast-container" id="toastContainer">
            <div class="toast">
                <div class="toast-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="toast-content">
                    {{ session('success') }}
                </div>
                <button type="button" class="toast-close" onclick="closeToast(this)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
        <script>
            function closeToast(btn) {
                const toast = btn.closest('.toast');
                toast.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => toast.remove(), 300);
            }
            setTimeout(() => {
                const toast = document.querySelector('.toast');
                if (toast) {
                    toast.style.animation = 'fadeOut 0.3s forwards';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 4000);
        </script>
    @endif

    <div class="login-card">

        <div class="logo">
    <div class="logo-icon">
        <i class="fa-solid fa-check"></i>
    </div>

    	<h1>
    		<span class="task-text">Task</span><span class="manager-text">Manager</span>
	</h1>

    <p>Quản lý công việc thông minh</p>
	</div>

        <h2>Chào mừng trở lại!</h2>

        <p class="description">
            Đăng nhập để tiếp tục quản lý
            công việc của bạn.
        </p>

        <a href="/auth/google" class="google-btn">

            <span class="google-icon-circle">
                <svg class="google-icon" viewBox="0 0 24 24">
   	     <path fill="#4285F4" d="M21.35 12.27c0-.79-.07-1.55-.23-2.27H12v4.3h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.42z"/>
    	     <path fill="#34A853" d="M12 21.5c2.63 0 4.84-.87 6.45-2.36l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.69-1.72-5.46-4.03H3.3v2.53A9.74 9.74 0 0 0 12 21.5z"/>
    	     <path fill="#FBBC05" d="M6.54 13.58A5.85 5.85 0 0 1 6.23 12c0-.55.11-1.08.31-1.58V7.89H3.3A9.75 9.75 0 0 0 2.25 12c0 1.57.38 3.06 1.05 4.11l3.24-2.53z"/>
    	     <path fill="#EA4335" d="M12 6.39c1.43 0 2.72.49 3.73 1.46l2.8-2.8C16.84 3.5 14.63 2.5 12 2.5a9.74 9.74 0 0 0-8.7 5.39l3.24 2.53C7.31 8.11 9.46 6.39 12 6.39z"/>
	        </svg>
            </span>

	    Đăng nhập bằng Google
        </a>

        <div class="security">
            🔒 Đăng nhập an toàn bằng tài khoản Google
        </div>

    </div>

</body>
</html>