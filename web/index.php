<?php
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

$units = $_GET['units'] ?? 'metric';
$units = in_array($units, ['metric', 'imperial'], true) ? $units : 'metric';

$weight = $_GET['weight'] ?? '';
$height = $_GET['height'] ?? '';
$age    = $_GET['age'] ?? '';
$gender = $_GET['gender'] ?? 'na';

$accent = '#7c3aed';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMI Calculator Version 2</title>
</head>
<body style="
  margin:0;
  font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, 'Apple Color Emoji','Segoe UI Emoji';
  background: radial-gradient(1200px 600px at 20% 10%, rgba(124,58,237,.18), transparent 60%),
              radial-gradient(900px 500px at 80% 20%, rgba(16,185,129,.16), transparent 55%),
              linear-gradient(180deg, #0b1020 0%, #070a14 100%);
  color:#e8eaf2;
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:24px;
">
<div style="
    width:100%;
    max-width:980px;
    display:grid;
    grid-template-columns: 1.1fr .9fr;
    gap:18px;
  ">

    <div style="
      background: rgba(255,255,255,0.06);
      border:1px solid rgba(255,255,255,0.10);
      border-radius:18px;
      padding:22px;
      box-shadow: 0 20px 60px rgba(0,0,0,.35);
      backdrop-filter: blur(10px);
    ">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
            <div>
                <div style="font-size:14px; opacity:.85; letter-spacing:.3px;">Health Tools</div>
                <h1 style="margin:6px 0 0 0; font-size:28px; line-height:1.15;">BMI Calculator Version 2</h1>
                <div style="margin-top:8px; font-size:14px; opacity:.8;">
                    2-service app: Web UI + API
                </div>
            </div>
            <div style="
                width:44px; height:44px; border-radius:14px;
                background: linear-gradient(135deg, <?= $accent ?>, #22c55e);
                display:flex; align-items:center; justify-content:center;
                box-shadow: 0 10px 30px rgba(124,58,237,.35);
                font-weight:800;
                ">BMI</div>
        </div>

        <form id="bmiForm" style="margin-top:18px;">
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <label style="display:flex; align-items:center; gap:8px; padding:10px 12px; border-radius:14px; cursor:pointer; background: rgba(124,58,237,.18); border:1px solid rgba(124,58,237,.55);">
                    <input type="radio" name="units" value="metric" checked style="accent-color: <?= $accent ?>;">
                    <span style="font-weight:700;">Metric</span>
                    <span style="opacity:.75; font-size:13px;">kg / cm</span>
                </label>

                <label style="display:flex; align-items:center; gap:8px; padding:10px 12px; border-radius:14px; cursor:pointer; background: rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.10);">
                    <input type="radio" name="units" value="imperial" style="accent-color: <?= $accent ?>;">
                    <span style="font-weight:700;">Imperial</span>
                    <span style="opacity:.75; font-size:13px;">lb / in</span>
                </label>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px; margin-top:14px;">
                <div>
                    <label style="display:block; font-size:13px; opacity:.85; margin-bottom:6px;">Weight</label>
                    <input name="weight" inputmode="decimal" placeholder="e.g. 70" value="<?= h($weight) ?>"
                           style="width:100%; box-sizing:border-box; padding:12px; border-radius:14px; outline:none; color:#e8eaf2; background: rgba(0,0,0,.18); border:1px solid rgba(255,255,255,.12);">
                </div>

                <div>
                    <label style="display:block; font-size:13px; opacity:.85; margin-bottom:6px;">Height</label>
                    <input name="height" inputmode="decimal" placeholder="e.g. 175" value="<?= h($height) ?>"
                           style="width:100%; box-sizing:border-box; padding:12px; border-radius:14px; outline:none; color:#e8eaf2; background: rgba(0,0,0,.18); border:1px solid rgba(255,255,255,.12);">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px; margin-top:12px;">
                <div>
                    <label style="display:block; font-size:13px; opacity:.85; margin-bottom:6px;">Age (optional)</label>
                    <input name="age" inputmode="numeric" placeholder="e.g. 23" value="<?= h($age) ?>"
                           style="width:100%; box-sizing:border-box; padding:12px; border-radius:14px; outline:none; color:#e8eaf2; background: rgba(0,0,0,.18); border:1px solid rgba(255,255,255,.12);">
                </div>

                <div>
                    <label style="display:block; font-size:13px; opacity:.85; margin-bottom:6px;">Gender (optional)</label>
                    <select name="gender"
                            style="width:100%; box-sizing:border-box; padding:12px; border-radius:14px; outline:none; color:#e8eaf2; background: rgba(0,0,0,.18); border:1px solid rgba(255,255,255,.12);">
                        <option value="na">Prefer not to say</option>
                        <option value="f">Female</option>
                        <option value="m">Male</option>
                    </select>
                </div>
            </div>

            <div style="display:flex; gap:10px; align-items:center; margin-top:16px; flex-wrap:wrap;">
                <button type="submit" style="
                    border:none; cursor:pointer;
                    padding:12px 14px;
                    border-radius:14px;
                    font-weight:800;
                    color:white;
                    background: linear-gradient(135deg, <?= $accent ?>, #22c55e);
                    box-shadow: 0 14px 40px rgba(124,58,237,.28);
                    ">
                    Calculate BMI
                </button>
            </div>
        </form>
    </div>

    <div style="
      background: rgba(255,255,255,0.06);
      border:1px solid rgba(255,255,255,0.10);
      border-radius:18px;
      padding:22px;
      box-shadow: 0 20px 60px rgba(0,0,0,.35);
      backdrop-filter: blur(10px);
      min-height: 320px;
    ">
        <div style="font-size:14px; opacity:.85;">Your Result</div>
        <div id="result" style="margin-top:16px; opacity:.85; line-height:1.6;">
            Enter your values and click <b>Calculate BMI</b>.
        </div>
    </div>
</div>

<style>
    @media (max-width: 920px) {
        body > div { grid-template-columns: 1fr !important; }
    }
</style>

<script>
    document.getElementById('bmiForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const payload = Object.fromEntries(formData.entries());

        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = 'Loading...';

        try {
            const response = await fetch('http://localhost:8081', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (!response.ok) {
                resultDiv.innerHTML = `
                <div style="padding:12px; border-radius:14px; background: rgba(239,68,68,.14); border:1px solid rgba(239,68,68,.35); color:#fecaca;">
                    <b>Error:</b><br>${(data.errors || ['Unknown error']).join('<br>')}
                </div>
            `;
                return;
            }

            resultDiv.innerHTML = `
            <div style="font-size:46px; font-weight:900; letter-spacing:-1px; line-height:1;">
                ${data.bmi}
            </div>
            <div style="margin-top:8px; font-weight:800;">${data.category}</div>
            <div style="margin-top:12px; padding:12px 14px; border-radius:16px; background: rgba(0,0,0,.18); border:1px solid rgba(255,255,255,.10); line-height:1.55; font-size:14px;">
                <div style="font-weight:900; margin-bottom:6px;">Next step</div>
                ${data.advice}
            </div>
        `;
        } catch (err) {
            resultDiv.innerHTML = `
            <div style="padding:12px; border-radius:14px; background: rgba(239,68,68,.14); border:1px solid rgba(239,68,68,.35); color:#fecaca;">
                API connection failed.
            </div>
        `;
        }
    });
</script>
</body>
</html>