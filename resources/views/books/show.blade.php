<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <style>
        #pdf-container {
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
        }

        @media print {
            .btn-secondary {
                display: none;
            }

            #pdf-container canvas {
                page-break-before: always;
            }

            body {
                visibility: hidden;
            }

            #pdf-container,
            #pdf-container * {
                visibility: visible;
            }

            @page {
                margin: 0;
                size: auto;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to Home</a>
    <div id="pdf-container"></div>

    <script>
        const pdfUrl = "{{ $pdfUrl }}";
        const previousPageUrl = "{{ route('books.index') }}";

        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            const container = document.getElementById('pdf-container');
            let pagesRendered = 0;

            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                pdf.getPage(pageNum).then(function(page) {
                    const scale = 1.5;
                    const viewport = page.getViewport({ scale: scale });

                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    container.appendChild(canvas);

                    page.render({ canvasContext: context, viewport: viewport }).promise.then(function() {
                        pagesRendered++;

                        if (pagesRendered === pdf.numPages) {
                            setTimeout(function() {
                                window.print();
                            }, 500);
                        }
                    });
                });
            }
        });

        window.onbeforeprint = function() {
            // add any action
        };

        window.onafterprint = function() {
            //  when canceled,
            if (!document.querySelector('.print-done')) {
                window.location.href = previousPageUrl;
            }
        };
    </script>
</body>
</html>
