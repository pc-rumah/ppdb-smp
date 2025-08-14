// File preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('bukti_pembayaran');
            const filePreview = document.getElementById('file-preview');
            const previewContent = document.getElementById('preview-content');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            const removeButton = document.getElementById('remove-file');

            fileInput.addEventListener('change', function(e) {
                // Clear previous preview
                previewContent.innerHTML = '';

                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    // Check file size (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.value = '';
                        filePreview.classList.remove('active');
                        return;
                    }

                    // Display file info
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);

                    // Show preview based on file type
                    const fileType = file.type;

                    if (fileType.startsWith('image/')) {
                        // Image preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'preview-image';
                            previewContent.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    } else if (fileType === 'application/pdf') {
                        // PDF preview (icon only)
                        const pdfPreview = document.createElement('div');
                        pdfPreview.className = 'pdf-preview';
                        pdfPreview.innerHTML = `
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-2 text-red-500">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <path d="M9 15v-4"></path>
                                    <path d="M12 15v-6"></path>
                                    <path d="M15 15v-2"></path>
                                </svg>
                                <p>Dokumen PDF</p>
                            </div>
                        `;
                        previewContent.appendChild(pdfPreview);
                    } else {
                        // Unsupported file type
                        alert('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
                        this.value = '';
                        filePreview.classList.remove('active');
                        return;
                    }

                    // Show preview container
                    filePreview.classList.add('active');
                } else {
                    // No file selected
                    filePreview.classList.remove('active');
                }
            });

            // Remove file button
            removeButton.addEventListener('click', function() {
                fileInput.value = '';
                filePreview.classList.remove('active');
                previewContent.innerHTML = '';
            });

            // Helper function to format file size
            function formatFileSize(bytes) {
                if (bytes < 1024) {
                    return bytes + ' bytes';
                } else if (bytes < 1024 * 1024) {
                    return (bytes / 1024).toFixed(1) + ' KB';
                } else {
                    return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
        const jenisPendaftaran = document.getElementById('jenis_pendaftaran');
        const buktiPembayaranGroup = document.getElementById('form-grouppembayaran');
        const buktiPembayaranInput = document.getElementById('bukti_pembayaran');

        function toggleBuktiPembayaran() {
        if (jenisPendaftaran.value === 'online') {
            buktiPembayaranGroup.classList.remove('hidden');
            buktiPembayaranInput.required = true;
        } else {
            buktiPembayaranGroup.classList.add('hidden');
            buktiPembayaranInput.required = false;
        }
}

        jenisPendaftaran.addEventListener('change', toggleBuktiPembayaran);

        // Trigger saat load pertama kali
        toggleBuktiPembayaran();
});

document.addEventListener('DOMContentLoaded', function () {
  const jenisPendaftaran     = document.getElementById('jenis_pendaftaran');

  // Bukti pembayaran
  const buktiPembayaranGroup = document.getElementById('form-grouppembayaran');
  const buktiPembayaranInput = document.getElementById('bukti_pembayaran');

  function toggleBuktiPembayaran() {
    if (jenisPendaftaran.value === 'online') {
      buktiPembayaranGroup.classList.remove('hidden');
      buktiPembayaranInput.required = true;
      buktiPembayaranInput.disabled = false;
    } else {
      buktiPembayaranGroup.classList.add('hidden');
      buktiPembayaranInput.required = false;
      buktiPembayaranInput.value = '';
      buktiPembayaranInput.disabled = true;
    }
  }

  // === BERKAS ===
  const berkasGroup = document.getElementById('form-groupberkas');
  const berkasInputs = berkasGroup.querySelectorAll('input[type="file"]');

  function toggleBerkas() {
    if (jenisPendaftaran.value === 'online') {
      berkasGroup.classList.remove('hidden');
      berkasInputs.forEach(inp => {
        inp.required = false;
        inp.disabled = false;
      });
    } else {
      berkasGroup.classList.add('hidden');
      berkasInputs.forEach(inp => {
        inp.required = false;
        inp.value = '';
        inp.disabled = true;
      });
    }
  }

  // Event + trigger awal
  jenisPendaftaran.addEventListener('change', () => {
    toggleBuktiPembayaran();
    toggleBerkas();
  });

  toggleBuktiPembayaran();
  toggleBerkas();
});
