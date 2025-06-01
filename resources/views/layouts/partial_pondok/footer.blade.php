<footer class="footer footer-center p-10 bg-base-300 text-base-content">
    <aside>
        <i class="fas fa-moon text-4xl text-primary"></i>
        <p class="font-bold text-xl">{{ $cover->judul_pondok ?? 'ini judul' }}</p>
        <p>Mencetak Ulama dan Huffadz Al-Quran</p>
        <p>Copyright © {{ date('Y') }} - All right reserved</p>
    </aside>
    <nav>
        <div class="grid grid-flow-col gap-4">
            <a href="{{ $sosmed->facebook_pondok ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-facebook"></i></a>
            <a href="{{ $sosmed->insta_pondok ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-instagram"></i></a>
            <a href="{{ $sosmed->youtube_pondok ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-youtube"></i></a>
            <a href="{{ $sosmed->twitter_pondok ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-twitter"></i></a>
            <a href="{{ $sosmed->tiktok_pondok ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-tiktok"></i></a>
        </div>
    </nav>
</footer>
