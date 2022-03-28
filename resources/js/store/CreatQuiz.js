import {defineStore} from 'pinia'

export const useCreatQuiz = defineStore('CreatQuiz', {
    state: () => {
        return {
            content: 0,
            questions: {},
        }
    },
    getters: {
        //
    },
    actions: {
        add(index, question = {}) {
            if (this.questions[index]) {
                this.questions[index] = question;
            } else {
                this.content++;
                this.questions = {...this.questions, [index]: question};
            }
        },
        remove(index) {
            this.content--;
            delete this.questions[index];
        },
    }
})
