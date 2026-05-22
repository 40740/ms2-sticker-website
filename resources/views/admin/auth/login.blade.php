<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>管理员登录 – MeisaiPrinting Admin</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #f3f4f6; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md px-6">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">MS <span class="text-[#FF008A]">Admin</span></h1>
                <p class="text-sm text-gray-500 mt-2">管理员登录</p>
            </div>

            @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">邮箱</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                               required autofocus>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">密码</label>
                        <input type="password" id="password" name="password"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                               required>
                    </div>

                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" value="1" class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#FF008A]/30 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#FF008A]"></div>
                            <span class="ms-2 text-sm text-gray-600">记住我</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-[#FF008A] text-white rounded-lg px-4 py-2.5 text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
                        登 录
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-[#FF008A] transition-colors">← 返回网站</a>
            </div>

            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg text-xs text-blue-700">
                <p class="font-semibold mb-1">默认登录账号：</p>
                <p>邮箱：admin@meisaiprinting.com</p>
                <p>密码：password</p>
            </div>
        </div>
    </div>
</body>
</html>
