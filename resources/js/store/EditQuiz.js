import {defineStore} from 'pinia'

export const useEditQuiz = defineStore('EditQuiz', {
    state: () => {
        return {
            content: 0, scoreQuiz: 0, questions: {}, deleted: [],
        }
    }, getters: {
        //
    }, actions: {
        add(index, question = {}, score = 0) {
            if (this.questions[index]) {
                this.scoreQuiz += +score;
                this.questions[index] = question;
            } else {
                this.content++;
                this.scoreQuiz += question.score;
                this.questions = {...this.questions, [index]: question};
            }
        }, remove(index) {
            this.content--;
            this.scoreQuiz -= +this.questions[index].score;
            delete this.questions[index];
            if (!isNaN(index)) {
                this.deleted.push(index);
            }
        }, clean() {
            this.content = 0;
            this.questions = {};
            this.deleted = [];
        }
    }
})
