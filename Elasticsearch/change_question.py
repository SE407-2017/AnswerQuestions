# -- coding: utf-8 --
#改变已有问题
from elasticsearch import Elasticsearch
import sys

def change_question(id_num, new_question):
    es = Elasticsearch([{'host':'localhost','port':9200}])
    res = es.get(index = "question_index", doc_type = "question", id = id_num)
    question_body = res['_source']
    question_body['content'] = new_question
    es.index(index = "question_index", doc_type = "question", id = id_num, body = question_body)

change_question(id_num = sys.argv[1], new_question = sys.argv[2])
