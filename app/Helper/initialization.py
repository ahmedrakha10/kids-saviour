import face_recognition
import os
import sys
import json

insImagePath = sys.argv[1]
insImage = face_recognition.load_image_file(insImagePath)

# Load the known face encodings and IDs from JSON files
with open(sys.argv[2], 'r') as f:
    knownFaceEncodings = json.load(f)

with open(sys.argv[3], 'r') as f:
    knownFaceIds = json.load(f)

# Get the face encodings
insFaceEncodings = face_recognition.face_encodings(insImage)
imgId = os.path.splitext(insImagePath)[0]

knownFaceIds.append(imgId)
knownFaceEncodings.append(insFaceEncodings)
print(json.dumps([knownFaceEncodings , knownFaceIds]))
