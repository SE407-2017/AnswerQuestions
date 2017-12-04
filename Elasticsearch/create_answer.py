# -- coding: utf-8 --
#生成新回答，可生成多个回答
from elasticsearch import Elasticsearch
import sys

def create_answer(id_num, answer, state):
    es = Elasticsearch([{'host':'localhost','port':9200}])
    res = es.get(index = "question_index", doc_type = "question",id = id_num)
    answer_body = {
        "content": res['_source']['content'],
        "response": res['_source']['response'].append(answer),
        "reply_num": res['_source']['reply_num']++,
        "response_state": state
    }
    es.index(index = "question_index", doc_type = "question", id = id_num, body = answer_body)

create_answer(id_num = sys.argv[1], answer = sys.argv[2], state = sys.argv[3])
