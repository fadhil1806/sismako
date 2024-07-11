<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guru CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            border-radius: 50%;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .section-content {
            font-size: 16px;
        }
        .section-content p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('img/tendik/Fadhil_Rabbani/Foto-Fadhil_Rabbani.png')}}" alt="">
            <h1>{{ $tendik->nama }}</h1>
            <p>{{ $tendik->posisi }}</p>
        </div>

        <div class="section">
            <div class="section-title">Informasi Pribadi</div>
            <div class="section-content">
                <p><strong>NIK:</strong> {{ $tendik->no_nik }}</p>
                <p><strong>GTK:</strong> {{ $tendik->no_gtk }}</p>
                <p><strong>NUPTK:</strong> {{ $tendik->no_nuptk }}</p>
                <p><strong>Tempat Tanggal Lahir:</strong> {{ $tendik->tempat_tanggal_lahir }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $tendik->tanggal_lahir }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $tendik->jenis_kelamin }}</p>
                <p><strong>Agama:</strong> {{ $tendik->agama }}</p>
                <p><strong>Alamat:</strong> {{ $tendik->alamat }}</p>
                <p><strong>Status Kepegawaian:</strong> {{ $tendik->status_kepegawaian }}</p>
                <p><strong>No Rekening:</strong> {{ $tendik->no_rekening }}</p>
                <p><strong>Email:</strong> {{ $tendik->email }}</p>
                <p><strong>Pendidikan Terakhir:</strong> {{ $tendik->pendidikan_terakhir }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $tendik->tanggal_masuk }}</p>
                <p><strong>Tanggal Keluar:</strong> {{ $tendik->tanggal_keluar }}</p>
                <p><strong>No HP:</strong> {{ $tendik->no_hp }}</p>
            </div>
        </div>
    </div>
    {{-- <script>
        async function getImage(namaDir, namaFile) {
            const url = `{{ asset('img/tendik/${namaDir}/${namaFile}') }}`;
            
            try {
                const response = await fetch(url);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                
                // Assuming the response is an image, create a Blob from the response
                const blob = await response.blob();
                const imageURL = URL.createObjectURL(blob);
                
                // Update the image element with the given id 'imgFile'
                const imgElement = document.getElementById('imgFile');
                if (imgElement) {
                    imgElement.src = imageURL;
                    console.log(`Image updated successfully:`, imageURL);
                } else {
                    throw new Error(`Image element with id 'imgFile' not found.`);
                }
                
                return imageURL;
            } catch (error) {
                console.error('Error fetching image:', error);
                // Handle errors or throw them to be caught elsewhere
                throw error;
            }
        }

        // Example usage in your Blade template (assuming $namaDir and $imageNamaFoto are PHP variables)
        const namaDir = @json($namaDir);
        const namaFile = @json($imageNamaFoto);
        
        getImage(namaDir, namaFile)
            .then(imageURL => {
                console.log(`Successfully updated image:`, imageURL);
            })
            .catch(error => {
                console.error(`Failed to update image:`, error);
                // Handle error: display an error message, retry fetch, etc.
            });
    </script> --}}
</body>
</html>
