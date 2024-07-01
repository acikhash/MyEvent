<!-- resources/views/scan.blade.php -->
@extends('layouts.app')

@section('content')
    <div id="scanner-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/instascan"></script>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('scanner-container')
        });

        scanner.addListener('scan', function (content) {
            // Handle scanned QR code content
            console.log(content);

            // Send the scanned content to server
            fetch('/process-scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ qrCodeContent: content })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        Instascan.Camera.getCameras().then(cameras => {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    </script>
@endsection