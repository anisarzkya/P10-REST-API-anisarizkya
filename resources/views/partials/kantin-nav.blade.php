
<nav>
    <a href="/kantin" @class(['aktif' => request()->is('kantin')])>
        Katalog Menu
    </a>
    <a href="/kantin/tentang" @class(['aktif' => request()->is('kantin/tentang')])>
        Tentang Kantin
    </a>
</nav>
