import pyautogui
import time
import csv

gebruikersnaam = "admin@Router1.localdomain"
wachtwoord = "P@ssw0rd1"

print(pyautogui.size())
pyautogui.hotkey("ctrl", "alt", "t")
time.sleep(2)
pyautogui.write('ssh ' + gebruikersnaam)
time.sleep(2)
pyautogui.hotkey("enter")
time.sleep(2)
pyautogui.write(wachtwoord)
time.sleep(2)
pyautogui.hotkey("enter")
time.sleep(2)
pyautogui.hotkey("8", "enter")
with open('rules.txt') as csvfile:
      reader = csv.DictReader(csvfile)
      for row in reader:
          i = (row['Interface'])
          s = (row['Source'])
          d = (row['Destination'])
          p1 = (row['Porttype'])
          p2 = (row['Portnumber'])
          pyautogui.write('easyrule pass ' +i + ' ' + p1 + ' ' + s + ' ' + d + ' ' + p2)
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

