<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    @include('partials.head')
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .blog-header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 50%, #1e3a8a 100%);
            color: white;
            padding: 3rem 0;
            clip-path: polygon(0 0, 100% 0, 100% calc(100% - 2rem), 0 100%);
        }

        .blog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .blog-nav {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(37, 99, 235, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(37, 99, 235, 0.2);
        }

        .blog-nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
        }

        .blog-logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .blog-nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .blog-nav-link {
            color: #cbd5e1;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .blog-nav-link:hover {
            color: #3b82f6;
        }

        .blog-nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            transition: width 0.3s ease;
        }

        .blog-nav-link:hover::after {
            width: 100%;
        }

        .blog-main {
            margin-top: -1rem;
            padding: 2rem 0;
        }

        .blog-article {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4), 0 0 1px rgba(37, 99, 235, 0.5);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .blog-article:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(37, 99, 235, 0.3), 0 0 1px rgba(37, 99, 235, 0.8);
            border-color: rgba(37, 99, 235, 0.3);
        }

        .blog-article-header {
            padding: 2rem;
        }

        .blog-article-featured {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blog-article-featured img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-article-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #f1f5f9;
            margin: 0 0 1rem 0;
            line-height: 1.4;
        }

        .blog-article-title a {
            color: #f1f5f9;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .blog-article-title a:hover {
            color: #3b82f6;
        }

        .blog-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            margin-right: 0.5rem;
        }

        .blog-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            font-size: 0.95rem;
            color: #cbd5e1;
            border-bottom: 2px solid rgba(37, 99, 235, 0.2);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .blog-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .blog-meta-item svg {
            width: 18px;
            height: 18px;
            color: #2563eb;
        }

        .blog-excerpt {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 1rem;
            margin: 1.5rem 0;
        }

        .blog-read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 2px solid transparent;
        }

        .blog-read-more:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            transform: translateX(5px);
        }

        .blog-footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #94a3b8;
            padding: 3rem 1.5rem;
            margin-top: 3rem;
            text-align: center;
            border-top: 1px solid rgba(37, 99, 235, 0.2);
        }

        .blog-footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .blog-pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin: 2rem 0;
        }

        .blog-pagination a,
        .blog-pagination span {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .blog-pagination span {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            font-weight: 600;
        }

        .blog-pagination a {
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            border: 2px solid #2563eb;
            text-decoration: none;
        }

        .blog-pagination a:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .blog-nav-links {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .blog-article-title {
                font-size: 1.4rem;
            }

            .blog-meta {
                gap: 1rem;
                font-size: 0.85rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .blog-article {
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="blog-nav">
        <div class="blog-nav-content">
            <a href="{{ route('home') }}" class="blog-logo">Baricode</a>
            <ul class="blog-nav-links">
                <li><a href="{{ route('home') }}" class="blog-nav-link">Beranda</a></li>
                <li><a href="{{ route('blog.index') }}" class="blog-nav-link">Blog</a></li>
                <li><a href="{{ route('lms.index') }}" class="blog-nav-link">LMS</a></li>
                @guest
                    <li><a href="{{ route('login') }}" class="blog-nav-link">Masuk</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('dashboard') }}" class="blog-nav-link">Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="blog-nav-link" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:inherit;font-weight:inherit;">Keluar</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="blog-main">
        @if (isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </div>

    <!-- Footer -->
    <footer class="blog-footer">
        <div class="blog-footer-content">
            <p>&copy; {{ date('Y') }} Baricode. Komunitas IT Keren di Indonesia.</p>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">Baca artikel terbaru dan terlengkap tentang teknologi dan programming.</p>
        </div>
    </footer>

    @fluxScripts
</body>

</html>
