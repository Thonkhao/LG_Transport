$ErrorActionPreference = 'Stop'
$projectPath = $PSScriptRoot
$phpPath = 'C:\php\php.exe'
if (!(Test-Path -LiteralPath $phpPath)) {
    $phpCommand = Get-Command php -ErrorAction SilentlyContinue
    if (!$phpCommand) { throw 'ไม่พบ PHP กรุณาติดตั้ง PHP หรือแก้ phpPath ใน start-local.ps1' }
    $phpPath = $phpCommand.Source
}
Write-Host 'LG Transport: http://127.0.0.1:8080'
Write-Host 'กด Ctrl+C เพื่อหยุดเซิร์ฟเวอร์'
& $phpPath -S 127.0.0.1:8080 -t $projectPath