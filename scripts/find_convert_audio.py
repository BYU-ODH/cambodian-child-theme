#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Wed Nov  4 11:47:19 2020

@author: briancroxall

Script to look for audio files in the COHP Box drive, produce a list of those
files and then convert any files that are not WAV to WAV.

Based on find_audio.py and ff-test.py.
"""
import os
from pprint import pprint
import subprocess
from datetime import datetime
import shutil
 

startTime = datetime.now()
year = str(startTime.year)
month = str(startTime.month)
day = str(startTime.day)
iso = f'{year}_{month}_{day}'


# Functions
def get_extension(filename):
    ext = filename.split('.')[-1]
    return ext


audioformats = ['pcm', 'wav', 'aiff', 'mp3', 'aac', 'ogg', 'wma', 'flac',
                'alac', 'm4a', 'mp4']
docformats = ['doc', 'docx', 'pdf', 'txt', 'md', 'odt', 'rtf', 'wpd', 'tex']

    # audio format lists
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

# doc format lists
doc = []
docx = []
pdf = []
txt = []
md = []
odt = []
rtf = []
wpd = []
tex = []


list_o_lists = [pcm, wav, aiff, mp3, aac, ogg, wma, flac, alac, m4a, mp4,
                other]
list_o_docs = [doc, docx, pdf, txt, md, odt, rtf, wpd, tex]

# Directories
BoxDir = '/Users/briancroxall/Box/COHP'
external = '/Volumes/Storage'
audio_dir = f'{external}/cohp-audio'
save_newname = f'{external}/cohp-audio/new_names_orig_format'
save_wav = f'{external}/cohp-audio/wav_and_text'
text_files = 'text_file_lists'


# Create directories
if not os.path.isdir(audio_dir):
    os.mkdir(audio_dir)
if not os.path.isdir(save_newname):
    os.mkdir(save_newname)
if not os.path.isdir(save_wav):
    os.mkdir(save_wav)
if not os.path.isdir(text_files):
    os.mkdir(text_files)

# Find all audio files in Box
for dirName, subdirList, fileList in os.walk(BoxDir, topdown=False):
    # print(f'dirName: {dirName}')
    # print(f'subdirList: {subdirList}')
    # print(f'fileList: {fileList}')
    if dirName.startswith('/Users/briancroxall/Box/COHP/Data/'):
        """
        The line above should make sure that we are only getting data from
        the folders that contain the interviews. It will pointedly skip
        over the Cobalt folder, meaning that we don't start duplicating
        data that we have already converted.
        """
        for fname in fileList:
            fname_ext = get_extension(fname)
            path = os.path.join(dirName, fname)
            if fname_ext in audioformats:
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
            elif fname_ext in docformats:
                if fname.endswith('doc'):
                    doc.append(path)
                elif fname.endswith('docx'):
                    docx.append(path)
                elif fname.endswith('pdf'):
                    pdf.append(path)
                elif fname.endswith('txt'):
                    txt.append(path)
                elif fname.endswith('md'):
                    md.append(path)
                elif fname.endswith('odt'):
                    odt.append(path)
                elif fname.endswith('rtf'):
                    rtf.append(path)
                elif fname.endswith('wpd'):
                    wpd.append(path)
                elif fname.endswith('tex'):
                    tex.append(path)
            else:
                continue
        else:
            continue

total_audio = 0
total_docs = 0

# Create lists of different audio formats
for _format in list_o_lists:
    if len(_format) > 0:
        total_audio += len(_format)
        form_name = _format[0].split('.')[-1]
        print(form_name, len(_format))
        with open(f'{audio_dir}/{form_name}_files.txt', 'w') as output:
            pass
        for each in _format:
            with open(f'{audio_dir}/{form_name}_files.txt', 'a') as output:
                pprint(each, stream=output)
print(f'\nTotal number of audio files to check: {total_audio}\n\n')
            
# create counts of document formats
for each in list_o_docs:
    if len(each) > 0:
        total_docs += len(each)
        doc_name = each[0].split('.')[-1]
        print(doc_name, len(each))

print(f'\nTotal number of documents to grab: {total_docs}\n\n')    

# create list of all text documents
with open(f'{text_files}/all_text_files.txt', 'w') as output:
    pass

for each in list_o_docs:
    for item in each:
        with open(f'{text_files}/all_text_files.txt', 'a') as output:
            print(item, file=output)

# Document to track what goes where
if not os.path.isfile(f'{audio_dir}/cohp-audio.tsv'):
    with open(f'{audio_dir}/cohp-audio.tsv', 'w') as tracker:
        print('original file location', 'original file format', 'renamed file',
              'wav location', 'associated text files', sep='\t', file=tracker)

# Document to see if I've already processed the file.
if not os.path.isfile(f'{audio_dir}/cohp-processed-audio.txt'):
    with open(f'{audio_dir}/cohp-processed-audio.txt', 'w') as tracker2:
        pass


transcode_counter = 0
total_counter = 0

for _format in list_o_lists:
    # size = len(_format)
    # extension = _format[0].split('.')[-1]
    # print(f'Starting to process {extension} files. Total of {size} files to process.')
    # TODO: remove counter/enumerate    
    for each in _format:
        total_counter += 1
        with open(f'{audio_dir}/cohp-processed-audio.txt') as checker:
            text = checker.read()
            if each in text:
                print(f'\n{each}: Already done!\n\n')
                continue
            else:
                print(f'Starting to work on {each}\n\n')
                transcode_counter += 1
                dir_name = each.split('/')[-2]
                new_dir_name = dir_name.replace(' ', '_').lower()  # remove spaces
                no_dir = each.split('/')[-1]
                ext = no_dir.split('.')[-1]
                new_name = no_dir.replace(' ', '_').lower()  # need to remove spaces from names before running bash commands
                no_ext_list = new_name.split('.')[:-1]  # doing this step just in case some file names have periods in them
                no_ext = '.'.join(no_ext_list)
                if not os.path.isdir(f'{save_wav}/{new_dir_name}'):  # create directory in wav_audio folder for the file
                    os.mkdir(f'{save_wav}/{new_dir_name}')
                shutil.copy2(each, f'{save_newname}/{new_name}')
                ff = subprocess.run(['ffmpeg', '-i',
                                     f'{save_newname}/{new_name}',
                                     '-ar', '16000', '-map_channel', '0.0.0',
                                     f'{save_wav}/{new_dir_name}/{no_ext}.wav'])
                """
                This next section finds text files that were in the audio
                file's original folder in Box.
                """
                docs = []
                short_docs = []
                with open(f'{text_files}/all_text_files.txt') as checker2:
                    for line in checker2:
                        if dir_name in line:
                            docs.append(line.rstrip())
                for item in docs:
                    short_name = item.split('/')[-1]
                    doc_ext = short_name.split('.')[-1]
                    fixed_short = short_name.replace(' ', '_').lower()
                    fixed2 = fixed_short.split('.')[:-1]
                    fixed3 = '.'.join(fixed2)
                    fixed3ext = f'{fixed3}.{doc_ext}'
                    short_docs.append(fixed3ext)
                    shutil.copy2(item, f'{save_wav}/{new_dir_name}/{fixed3ext}')
                """
                End find text files
                """
                with open(f'{audio_dir}/cohp-audio.tsv', 'a') as tracker:
                    print(each, ext, f'{save_newname}/{new_name}',
                          f'{save_wav}/{no_ext}.wav', short_docs, sep='\t',
                          file=tracker)
                with open(f'{audio_dir}/cohp-processed-audio.txt', 'a') as tracker2:
                    print(each, file=tracker2)
                print(f'Files done so far: {total_counter}\n\n')
print('\nTime elapsed: ', datetime.now() - startTime)
print('Number of files examined:', total_counter + 1,
      f'\nNumber of files transcoded: {transcode_counter}')

