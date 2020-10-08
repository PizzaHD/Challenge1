import pyautogui
import time
import csv

gebruikersnaam = "admin@Router1.localdomain"
wachtwoord = "P@ssw0rd1"

print(pyautogui.size())
pyautogui.hotkey("ctrl", "alt", "t")
time.sleep(2)
pyautogui.write('ssh' + gebruikersnaam)
pyautogui.hotkey("enter")
time.sleep(2)
with open('rules.txt') as csvfile:
      reader = csv.DictReader(csvfile)
      for row in reader:
          p1 = (row['Porttype'])
          p2 = (row['Portnumber'])
          pyautogui.write('easyrule pass lan ' + p1, 'wan lan ' + p2)
          pyautogui.hotkey("enter")
          time.sleep(2)

pyautogui.hotkey("enter")
pyautogui.write('exit')
time.sleep(2)
pyautogui.hotkey("enter")
pyautogui.hotkey("ctrl", "d")
time.sleep(2)
pyautogui.write('exit')
pyautogui.hotkey("enter")

