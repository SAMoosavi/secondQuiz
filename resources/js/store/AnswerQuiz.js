import {defineStore} from "pinia";

export const useAnswerQuiz = defineStore("AnswerQuiz", {
    state: () => {
        return {
            answer: {},
            answered: 0,
            counter: 0,
        };
    },
    actions: {
        setAnswer(index, answer){
            localStorage.setItem(index, answer);
            if ( !this.answer[index]){
                this.answered++;
                this.answer[index] = answer;
            } else {
                this.answer = {...this.answer, [index]: answer};
            }
            if (answer === "" || answer === null){
                this.answered--;
                delete this.answer[index];
                localStorage.removeItem(index);
            }
        },
        addCounter(){
            this.counter++;
        },
        clear(){
            localStorage.clear();
            this.answer = {};
            this.answered = 0;
        },
    },

});
