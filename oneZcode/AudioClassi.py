from scipy import io 
from scipy import signal
import numpy as np 
from scipy.signal import find_peaks

import requests

node_id = 'EBF1'
node_key = '0014eb71'


MOTHERSHIP = 'http://192.168.1.190/detection.php'

def compare_audio(filepath):
    fs, data = io.wavfile.read(filepath)
    audio = data.T[0]
    freqs, times, zxx = signal.spectrogram(audio, fs)
    peaks, _ = signal.find_peaks(zxx[0], distance=30)
    return peaks

def similarity(a,b):
    file1 = []
    file2 = []
    hashVal1 = []
    hashVal2 = []
    cert = 0

    for each in a:
        file1.append(each)
    for i in range(len(file1)-1):
        fo = file1[i]
        f = file1[i+1]
        dt = f - fo
        cantor = (fo+f+1)*(fo+f)/2+f
        hashh = (fo+((f+dt+1)*(f+dt)/2+dt))*(fo+((f+dt+1)*(f+dt)/2+dt))/2+((f+dt+1)*(f+dt)/2+dt)
        hashVal1.append(hashh)
    for each in b:
        file2.append(each)
    for x in range(len(file2)-1):
        fo = file2[x]
        f = file2[x+1]
        dt = f - fo
        cantor = (fo+f+1)*(fo+f)/2+f
        hashh = (fo+((f+dt+1)*(f+dt)/2+dt))*(fo+((f+dt+1)*(f+dt)/2+dt))/2+((f+dt+1)*(f+dt)/2+dt)
        hashVal2.append(hashh)    
    for each in hashVal1:
        for i in range(len(hashVal2)):
            if each == hashVal2[i]:
                cert+=1    
    certainty = int((cert/len(hashVal2))) 


    return certainty

certainty = similarity(compare_audio('C:\\Users/antho/Desktop/index/oneZcode/7061-6-0-0.wav'),compare_audio('C:\\Users/antho/Desktop/index/oneZcode/7061-6-0-0.wav'))

print(certainty)

data = {'detection':certainty,
        'node_id':node_id,
        'node_key':node_key
        }
r = requests.post(url=MOTHERSHIP, data=data)
response = r.text
print(response)
