<footer class="footer footer-center p-10 bg-base-300 text-base-content">
    <aside>
        <i class="fas fa-school text-4xl text-primary"></i>
        <p class="font-bold text-xl">{{ $cover->judul_smp ?? 'ini footer' }}</p>
        <p>Sekolah Unggul Berkarakter</p>
        <p>Copyright © {{ date('Y') }} - All rights reserved</p>
    </aside>
    <nav>
        <div class="grid grid-flow-col gap-4">
            <a href="{{ $sosmed->facebook_smp ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-facebook"></i></a>
            <a href="{{ $sosmed->insta_smp ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-instagram"></i></a>
            <a href="{{ $sosmed->youtube_smp ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-youtube"></i></a>
            <a href="{{ $sosmed->twitter_smp ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-twitter"></i></a>
            <a href="{{ $sosmed->tiktok_smp ?? '#' }}" class="text-2xl hover:text-primary transition-colors"><i
                    class="fab fa-tiktok"></i></a>
        </div>
    </nav>
</footer>
