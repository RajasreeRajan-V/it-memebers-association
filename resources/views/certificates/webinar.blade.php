<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            width: 297mm;
            height: 210mm;
            position: relative;
            background: #ffffff;
        }
        .frame {
            box-sizing: border-box;
            width: 297mm;
            height: 210mm;
            position: relative;
            overflow: hidden;
        }

        /* Outer thin border */
        .border-line {
            position: absolute;
            top: 14mm;
            left: 14mm;
            right: 14mm;
            bottom: 14mm;
            border: 1.5px solid #1e293b;
        }

        /* ===== Corner triangles (top-left) ===== */
        .tri-navy-tl {
            position: absolute;
            top: 0; left: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 95mm 95mm 0 0;
            border-color: #1e293b transparent transparent transparent;
        }
        .tri-gold-tl {
            position: absolute;
            top: 0; left: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 78mm 78mm 0 0;
            border-color: #c9a227 transparent transparent transparent;
        }
        .tri-white-tl {
            position: absolute;
            top: 0; left: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 70mm 70mm 0 0;
            border-color: #ffffff transparent transparent transparent;
        }

        /* ===== Corner triangles (bottom-right) ===== */
        .tri-navy-br {
            position: absolute;
            bottom: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 0 95mm 95mm;
            border-color: transparent transparent #1e293b transparent;
        }
        .tri-gold-br {
            position: absolute;
            bottom: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 0 78mm 78mm;
            border-color: transparent transparent #c9a227 transparent;
        }
        .tri-white-br {
            position: absolute;
            bottom: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 0 70mm 70mm;
            border-color: transparent transparent #ffffff transparent;
        }

        /* ===== Content ===== */
        .content {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            text-align: center;
            padding-top: 32mm;
        }

        h1 {
            font-size: 46px;
            letter-spacing: 10px;
            color: #374151;
            font-weight: bold;
            margin: 0;
        }
        .subtitle {
            font-size: 18px;
            letter-spacing: 6px;
            color: #c9a227;
            font-weight: bold;
            margin: 4px 0 20px;
        }

        .presented {
            font-size: 12px;
            letter-spacing: 2px;
            color: #4b5563;
            font-weight: bold;
            margin-bottom: 14px;
        }

        .name {
            font-family: 'DejaVu Serif', serif;
            font-style: italic;
            font-size: 40px;
            color: #1e293b;
            margin: 0 auto 6px;
            display: inline-block;
            padding: 0 30px 8px;
            border-bottom: 1px solid #9ca3af;
        }

        .desc-title {
            font-size: 13px;
            letter-spacing: 1px;
            color: #4b5563;
            font-weight: bold;
            margin-top: 26px;
        }
        .desc-body {
            font-size: 12px;
            color: #6b7280;
            max-width: 500px;
            margin: 6px auto 0;
            line-height: 1.5;
        }

     .footer {
    position: absolute;
    bottom: 38mm;
    left: 55mm;
    right: 55mm;
    width: auto;
}
.footer-block {
    width: 45%;
    text-align: center;
    display: inline-block;
}
.footer-block.left {
    float: left;
}
.footer-block.right {
    float: right;
}
.footer-line {
    border-top: 1px solid #9ca3af;
    padding-top: 6px;
    font-size: 13px;
    color: #374151;
}
.footer-label {
    font-size: 10px;
    letter-spacing: 1px;
    color: #9ca3af;
    margin-top: 4px;

        }
    </style>
</head>
<body>
    <div class="frame">
        <div class="tri-navy-tl"></div>
        <div class="tri-gold-tl"></div>
        <div class="tri-white-tl"></div>

        <div class="tri-navy-br"></div>
        <div class="tri-gold-br"></div>
        <div class="tri-white-br"></div>

        <div class="border-line"></div>

        <div class="content">
            <h1>CERTIFICATE</h1>
            <div class="subtitle">OF ACHIEVEMENT</div>

            <div class="presented">THIS CERTIFICATE IS PROUDLY PRESENTED TO:</div>
            <div class="name">{{ $student->name }}</div>

            <div class="desc-title">{{ strtoupper($webinar->title) }}</div>
            <div class="desc-body">
                For successfully attending and completing the {{ $webinar->type }}
                conducted by {{ $webinar->mentor->name ?? 'the mentor' }} on {{ $date }}.
            </div>

          <div class="footer">
    <div class="footer-block left">
        <div class="footer-line">{{ now()->format('d / m / Y') }}</div>
        <div class="footer-label">DATE</div>
    </div>
    <div class="footer-block right">
        <div class="footer-line">WB{{ $webinar->id }}-{{ $student->id }}</div>
        <div class="footer-label">CERTIFICATE ID</div>
    </div>
</div>
        </div>
    </div>
</body>
</html>