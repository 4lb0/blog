from transformers import pipeline

# Este modelo esta en español
model = "timpal0l/mdeberta-v3-base-squad2"

nlp = pipeline('question-answering', model=model, tokenizer=model)
qa = {
    'context': 'Me llamo Rodrigo y me dicen Albo.',
    'question': 'Cual es mi nombre?' 
}
res = nlp(qa)
print(res)
