<section id="about" class="py-20 bg-neutral">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Unit Sekolah Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Primary School Card -->
            <div class="card bg-base-100 shadow-xl">
                <figure><img src="https://placehold.co/600x400?text=Primary+School" alt="Primary School" />
                </figure>
                <div class="card-body">
                    <h3 class="card-title">Primary School (SD)</h3>
                    <p>Building a strong foundation for lifelong learning</p>
                    <div class="card-actions justify-end">
                        <button class="btn bg-primary hover:bg-primary/80"
                            onclick="document.getElementById('modal-primary').showModal()">Details</button>
                    </div>
                </div>
            </div>

            <!-- Junior High School Card -->
            <div class="card bg-base-100 shadow-xl">
                <figure><img src="https://placehold.co/600x400?text=Junior+High+School" alt="Junior High School" />
                </figure>
                <div class="card-body">
                    <h3 class="card-title">Junior High School (SMP)</h3>
                    <p>Developing critical thinking and personal growth</p>
                    <div class="card-actions justify-end">
                        <button class="btn bg-secondary hover:bg-secondary/80"
                            onclick="document.getElementById('modal-junior').showModal()">Details</button>
                    </div>
                </div>
            </div>

            <!-- Senior High School Card -->
            <div class="card bg-base-100 shadow-xl">
                <figure><img src="https://placehold.co/600x400?text=Senior+High+School" alt="Senior High School" />
                </figure>
                <div class="card-body">
                    <h3 class="card-title">Senior High School (SMA)</h3>
                    <p>Preparing students for university and beyond</p>
                    <div class="card-actions justify-end">
                        <button class="btn bg-accent hover:bg-accent/80"
                            onclick="document.getElementById('modal-senior').showModal()">Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Primary School Modal -->
    <dialog id="modal-primary" class="modal">
        <div class="modal-box max-w-4xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <img src="https://placehold.co/800x600?text=Primary+School" alt="Primary School"
                        class="rounded-lg w-full">
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-4">Primary School (SD)</h3>
                    <p class="mb-4">Our primary school program focuses on building a strong foundation in
                        literacy, numeracy, and essential life skills.</p>

                    <h4 class="text-xl font-semibold mb-2">Facilities:</h4>
                    <ul class="list-disc pl-5 mb-4">
                        <li>Modern classrooms with interactive whiteboards</li>
                        <li>Dedicated science and computer labs</li>
                        <li>Library with age-appropriate resources</li>
                        <li>Playground and sports facilities</li>
                        <li>Art and music rooms</li>
                    </ul>

                    <h4 class="text-xl font-semibold mb-2">Key Strengths:</h4>
                    <ul class="list-disc pl-5">
                        <li>Low student-to-teacher ratio</li>
                        <li>Integrated curriculum approach</li>
                        <li>Focus on character development</li>
                        <li>Regular parent-teacher communication</li>
                        <li>Extracurricular activities</li>
                    </ul>
                </div>
            </div>
        </div>
    </dialog>

    <!-- Junior High School Modal -->
    <dialog id="modal-junior" class="modal">
        <div class="modal-box max-w-4xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <img src="https://placehold.co/800x600?text=Junior+High+School" alt="Junior High School"
                        class="rounded-lg w-full">
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-4">Junior High School (SMP)</h3>
                    <p class="mb-4">Our junior high program builds on the primary foundation, introducing more
                        complex subjects and developing critical thinking skills.</p>

                    <h4 class="text-xl font-semibold mb-2">Facilities:</h4>
                    <ul class="list-disc pl-5 mb-4">
                        <li>Specialized subject classrooms</li>
                        <li>Advanced science laboratories</li>
                        <li>Computer and technology labs</li>
                        <li>Sports complex and gymnasium</li>
                        <li>Performing arts center</li>
                    </ul>

                    <h4 class="text-xl font-semibold mb-2">Key Strengths:</h4>
                    <ul class="list-disc pl-5">
                        <li>Subject specialist teachers</li>
                        <li>Project-based learning approach</li>
                        <li>Leadership development programs</li>
                        <li>Academic competitions and olympiads</li>
                        <li>Career exploration opportunities</li>
                    </ul>
                </div>
            </div>
        </div>
    </dialog>

    <!-- Senior High School Modal -->
    <dialog id="modal-senior" class="modal">
        <div class="modal-box max-w-4xl">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <img src="https://placehold.co/800x600?text=Senior+High+School" alt="Senior High School"
                        class="rounded-lg w-full">
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-4">Senior High School (SMA)</h3>
                    <p class="mb-4">Our senior high program prepares students for university and career success
                        with specialized tracks and advanced coursework.</p>

                    <h4 class="text-xl font-semibold mb-2">Facilities:</h4>
                    <ul class="list-disc pl-5 mb-4">
                        <li>University-style lecture halls</li>
                        <li>Research laboratories</li>
                        <li>Advanced technology center</li>
                        <li>Career counseling office</li>
                        <li>College preparation resources</li>
                    </ul>

                    <h4 class="text-xl font-semibold mb-2">Key Strengths:</h4>
                    <ul class="list-disc pl-5">
                        <li>Multiple academic tracks (Science, Social Studies, Language)</li>
                        <li>University preparation program</li>
                        <li>Internship opportunities</li>
                        <li>Advanced placement courses</li>
                        <li>College application support</li>
                    </ul>
                </div>
            </div>
        </div>
    </dialog>
</section>
