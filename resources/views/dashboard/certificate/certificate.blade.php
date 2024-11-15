<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Template</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            flex-direction: column;
        }

        .certificate {
            width: 1000px;
            height: 700px;
            position: relative;
            padding: 40px;
            box-sizing: border-box;
            background-color: #ffffff;
            border: 2px solid #d4d4d4;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .color-strip {
            position: absolute;
            width: 100vw;
            height: 100vh;
        }

        .color-strip.blue {
            top: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background-color: #003366; 
            clip-path: polygon(0 0, 100% 0, 0 100%);
        }

        .color-strip.gold {
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60%; 
            background-color: #d4af37; 
            clip-path: polygon(100% 0, 100% 100%, 0 100%);
        }

        .certificate .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 50px;
            z-index: 1;
        }

        .certificate .logo img {
            width: 80px;
            height: 80px;
        }

        .certificate .header {
            text-align: center;
            z-index: 1;
        }

        .certificate .header h1 {
            font-size: 30px;
            margin: 0;
            letter-spacing: 2px;
        }

        .certificate .header p {
            font-size: 18px;
            margin: 10px 0;
        }

        .certificate .content {
            text-align: center;
            z-index: 1;
        }

        .certificate .content h2 {
            font-size: 40px;
            margin: 0;
        }

        .certificate .content p {
            font-size: 18px;
            margin: 10px 0;
            max-width: 600px;
            margin: 0 auto;
            padding-top: 15px;
        }

        .certificate .footer {
            display: flex;
            justify-content: space-between;
            padding: 0 50px;
            z-index: 1;
        }

        .certificate .footer .date,
        .certificate .footer .signature {
            border-top: 1px solid #000;
            width: 150px;
            text-align: center;
            padding-top: 5px;
            font-size: 16px;
        }

        .print-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #003366; 
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        @media print {
            body {
                margin: 0;
                background: none;
                -webkit-print-color-adjust: exact;
            }

            .certificate {
                border: none;
                box-shadow: none;
                width: 100vw;
                height: 100vh;
                page-break-inside: avoid;
            }

            .color-strip.blue {
                background-color: #003366 !important; 
                clip-path: polygon(0 0, 100% 0, 0 100%);
            }

            .color-strip.gold {
                background-color: #d4af37 !important;
                clip-path: polygon(100% 0, 100% 100%, 0 100%);
            }

            .print-button {
                display: none;
            }

            @page {
                size: landscape;
                margin: 0;
            }

            .page-header, .page-footer, .print-footer, .no-print {
                display: none !important;
            }
        }

        .certificate .header .arabic-text {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
            color: #333;
        }

        .certificate .logo div {
            text-align: center;
            margin: 0 20px;
        }

        .certificate .logo h1,
        .certificate .logo h2,
        .certificate .logo h3 {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="color-strip blue"></div>
        <div class="color-strip gold"></div>
        <div class="logo">
            <img src="{{ asset('assets/logo/logo.jpg') }}" alt="Logo" class="left-logo">
            <div>
                <h1 >الجمهورية الجزائرية الديموقراطية الشعبية</h1>
                <h2 >وزارة التعليم العالي والبحث العلمي</h2>
                <h3 >جامعة الوادي - جامعة الشهيد حمه لخضر بالوادي</h3>
            </div>
            <img src="{{ asset('assets/logo/logo.jpg') }}" alt="Logo" class="right-logo">
        </div>
        <div class="header">
            <h1>ATTESTAION</h1>
            <p>DE PARTICIPATION A LA FORMATION </p>
        </div>
        <div class="content">
            @if ($student)
                <p>Nous Attestons que:</p>
                <h2> {{$student->full_name_fr}}</h2>
                <p>
                    A suivi avec assiduité la formation 
                    <strong> 
                        << {{ $currentStage }} >>
                    </strong> organisée par l'incubateur de l'université d'el-Oued.
                </p>
            @endif
        </div>
        <div class="footer">
            <div class="date">Date</div>
            <div class="signature">Signature</div>
        </div>
    </div>
</body>
</html>
