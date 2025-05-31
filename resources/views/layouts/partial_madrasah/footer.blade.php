<footer class="footer footer-center p-10 bg-base-200 text-base-content">
    <aside>
        <i class="fas fa-mosque text-4xl text-primary"></i>
        <p class="font-bold text-xl">{{ $cover->judul_madrasah }}</p>
        <p>Pendidikan Islam Terpadu Berkualitas</p>
        <p>Copyright © 2024 - All right reserved</p>
    </aside>
    <nav>
        <div class="grid grid-flow-col gap-4">
            <div class="grid grid-flow-col gap-4">
                <a href="{{ $sosmed->facebook_madrasah }}" class="text-2xl hover:text-primary transition-colors"><i
                        class="fab fa-facebook"></i></a>
                <a href="{{ $sosmed->insta_madrasah }}" class="text-2xl hover:text-primary transition-colors"><i
                        class="fab fa-instagram"></i></a>
                <a href="{{ $sosmed->youtube_madrasah }}" class="text-2xl hover:text-primary transition-colors"><i
                        class="fab fa-youtube"></i></a>
                <a href="{{ $sosmed->twitter_madrasah }}" class="text-2xl hover:text-primary transition-colors"><i
                        class="fab fa-twitter"></i></a>
                <a href="{{ $sosmed->tiktok_madrasah }}" class="text-2xl hover:text-primary transition-colors"><i
                        class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </nav>
</footer>
