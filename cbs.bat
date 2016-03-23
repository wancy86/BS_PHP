@echo off
git status
git add .
echo Please input comment:
set /p comments=
git commit -m "%comments%"
git push origin master


