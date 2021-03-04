<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')


    <title>Blog</title>
</head>
<body>
<div class="conteiner">
    <div class="nav">
        <ul class="menu">

            <li class="menu-1">
                <p class="menu-link">Category</p>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{route('category.create')}}" class="submenu-link">Create Category</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{route('category.index')}}" class="submenu-link">List Categories</a>
                    </li>
                </ul>
            </li>

            <li class="menu-1">
                <p class="menu-link">Tag</p>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{route('tag.create')}}" class="submenu-link">Create Tag</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{route('tag.index')}}" class="submenu-link">List tags</a>
                    </li>
                </ul>
            </li>


            <li class="menu-1">
                <p class="menu-link">Post</p>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{route('post.create')}}" class="submenu-link">Create Post</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{route('post.index')}}" class="submenu-link">List Posts</a>
                    </li>

                    <li class="submenu-item">
                        <a href="{{route('post.search')}}" class="submenu-link">Search by all</a>
                    </li>
                </ul>
            </li>
            @auth()
                <li class="menu-1">

                    <a href="{{route('auth.logout')}}" class="submenu-link">Logout</a>
                </li>
            @endauth
            @guest()
                <li class="menu-1">

                    <a href="{{route('login')}}" class="submenu-link">sing in</a>
                </li>
                <li class="menu-1">

                    <a href="{{route('user.create')}}" class="submenu-link">sing up</a>
                </li>
            @endguest
        </ul>
    </div>
    @yield('content')
    @yield('paginator')
</div>
</body>
</html>
