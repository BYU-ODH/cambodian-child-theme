#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Wed Oct 14 09:22:00 2020

@author: briancroxall

Script to find all the audio of selected formats in the COHP box folders
"""
import os
from pprint import pprint

def get_extension(filename):
    ext = filename.split('.')[-1]
    return ext

audioformats = ['pcm', 'wav', 'aiff', 'mp3', 'aac', 'ogg', 'wma', 'flac',
                'alac', 'm4a', 'mp4']

pcm = []
wav = []
aiff = []
mp3 = []
aac = []
ogg = []
wma = []
flac = []
alac = []
m4a = []
mp4 = []
other = []

list_o_lists = [pcm, wav, aiff, mp3, aac, ogg, wma, flac, alac, m4a, mp4,
                other]

rootDir = '/Users/briancroxall/Box/COHP'
for dirName, subdirList, fileList in os.walk(rootDir, topdown=False):
    #print('Found directory: %s' % dirName)
    for fname in fileList:
        fname_ext = get_extension(fname)
        if fname_ext in audioformats:
            path = os.path.join(dirName, fname)
            if fname.endswith('pcm'):
                pcm.append(path)
            elif fname.endswith('wav'):
                wav.append(path)
            elif fname.endswith('aiff'):
                aiff.append(path)
            elif fname.endswith('mp3'):
                mp3.append(path)
            elif fname.endswith('aac'):
                aac.append(path)
            elif fname.endswith('ogg'):
                ogg.append(path)
            elif fname.endswith('wma'):
                wma.append(path)
            elif fname.endswith('flac'):
                flac.append(path)
            elif fname.endswith('alac'):
                alac.append(path)
            elif fname.endswith('m4a'):
                m4a.append(path)
            elif fname.endswith('mp4'):
                mp4.append(path)
            else:
                other.append(path)
        else:
            continue
        
total_files = 0

for form in list_o_lists:
    if len(form) > 0:
        total_files += len(form)
        """
        form_name = form[1].split('.')[-1]
        print(form_name, len(form))
        with open(f'/Users/briancroxall/Documents/github/cohp-scripts/audio_file_lists/{form_name}.txt', 'w') as output:
            pass
        for each in form:
            with open(f'/Users/briancroxall/Documents/github/cohp-scripts/audio_file_lists/{form_name}.txt', 'a') as output:
                pprint(each, stream=output)
        """
print(total_files)