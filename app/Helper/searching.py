import face_recognition
import os
import sys
import json

# Get the path to the input image
inputImagePath = sys.argv[1]

# Load the input image
inputImage = face_recognition.load_image_file(inputImagePath)

# Load the known face encodings and IDs from JSON files
with open(sys.argv[2], 'r') as f:
    knownFaceEncodings = json.load(f)

with open(sys.argv[3], 'r') as f:
    knownFaceIds = json.load(f)

# Get the face encodings for all faces in the input image
input_face_encodings = face_recognition.face_encodings(inputImage)

# Loop through all the input face encodings
matchingIds = []
for input_face_encoding in input_face_encodings:
    # Compare the input face encoding to the list of known face encodings
    matches = face_recognition.compare_faces(knownFaceEncodings, input_face_encoding)

    # Loop through the list of matches to find the names of the images that match the input face
    for i, match in enumerate(matches):
        if match:
            matchingIds.append(knownFaceIds[i])

print(json.dumps([matchingIds]))
