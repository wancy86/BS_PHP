@echo off
git status
git add .
echo Please input comment:
set /p input_source=
git commit -m "!input_source!"
git push origin master
