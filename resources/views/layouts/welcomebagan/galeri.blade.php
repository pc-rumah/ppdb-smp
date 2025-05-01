<!-- Gallery Section -->
<section id="gallery" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold section-title">Galeri Sekolah</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Gallery Items -->
            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('School Campus', 'Our beautiful main campus building surrounded by gardens.', 'https://placehold.co/800x600/3b82f6/ffffff?text=School+Campus')">
                <img src="https://placehold.co/400x300/3b82f6/ffffff?text=School+Campus" alt="School Campus"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">School Campus</h3>
                </div>
            </div>

            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('Science Lab', 'Students engaged in a chemistry experiment in our state-of-the-art science lab.', 'https://placehold.co/800x600/4ade80/ffffff?text=Science+Lab')">
                <img src="https://placehold.co/400x300/4ade80/ffffff?text=Science+Lab" alt="Science Lab"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">Science Lab</h3>
                </div>
            </div>

            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('Library', 'Our extensive library with thousands of books and digital resources.', 'https://placehold.co/800x600/f97316/ffffff?text=Library')">
                <img src="https://placehold.co/400x300/f97316/ffffff?text=Library" alt="Library"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">Library</h3>
                </div>
            </div>

            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('Sports Field', 'Students playing soccer on our well-maintained sports field.', 'https://placehold.co/800x600/a855f7/ffffff?text=Sports+Field')">
                <img src="https://placehold.co/400x300/a855f7/ffffff?text=Sports+Field" alt="Sports Field"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">Sports Field</h3>
                </div>
            </div>

            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('Art Studio', 'Creative works in progress in our art studio.', 'https://placehold.co/800x600/ec4899/ffffff?text=Art+Studio')">
                <img src="https://placehold.co/400x300/ec4899/ffffff?text=Art+Studio" alt="Art Studio"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">Art Studio</h3>
                </div>
            </div>

            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('Computer Lab', 'Students learning programming and digital skills.', 'https://placehold.co/800x600/06b6d4/ffffff?text=Computer+Lab')">
                <img src="https://placehold.co/400x300/06b6d4/ffffff?text=Computer+Lab" alt="Computer Lab"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">Computer Lab</h3>
                </div>
            </div>

            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('Music Room', 'Students practicing with various musical instruments.', 'https://placehold.co/800x600/eab308/ffffff?text=Music+Room')">
                <img src="https://placehold.co/400x300/eab308/ffffff?text=Music+Room" alt="Music Room"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">Music Room</h3>
                </div>
            </div>

            <div class="gallery-item rounded-lg overflow-hidden shadow-lg"
                onclick="openModal('Cafeteria', 'Our spacious cafeteria serving nutritious meals.', 'https://placehold.co/800x600/14b8a6/ffffff?text=Cafeteria')">
                <img src="https://placehold.co/400x300/14b8a6/ffffff?text=Cafeteria" alt="Cafeteria"
                    class="w-full h-64 object-cover">
                <div class="p-2 bg-base-100">
                    <h3 class="font-bold">Cafeteria</h3>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <button class="btn btn-primary">Show All Gallery Images</button>
        </div>
    </div>
</section>

<!-- Gallery Modal -->
<dialog id="gallery_modal" class="modal">
    <div class="modal-box max-w-3xl">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 id="modal_title" class="font-bold text-lg mb-2"></h3>
        <img id="modal_image" src="/placeholder.svg" alt="" class="w-full h-auto rounded-lg mb-4">
        <p id="modal_description" class="text-gray-700"></p>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
