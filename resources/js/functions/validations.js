export function validEmail(email) {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
}

export function passwordConfirmation(password, passwordConfirmation) {
    return !(!password || !passwordConfirmation || password !== passwordConfirmation);
}

export function password(pass) {
    let errors = [];
    // if (pass.length < 8) errors.push("رمز باید حداقل 8 کاراکتر باشد");
    // if (!pass.match(/[0-9]/g)) errors.push("رمز باید شامل رقم باشد");
    // if (!pass.match(/[A-Z]/g)) errors.push("رمز باید شامل حروف بزرگ باشد");
    // if (!pass.match(/[a-z]/g)) errors.push("رمز باید شامل حروف کوچک باشد");
    // if (!pass.match(/^\S*$/g)) errors.push("رمز نباید شامل فاصله باشد");
    const esChar = /^(?=.*[~`!@#$%^&*()--+={}\[\]|\\:;"'<>,.?/_₹]).*$/g;
    // if (!pass.match(esChar)) errors.push("رمز باید شامل کاراکتر های خاص باشد");
    return errors;
}

export function required() {
    for (const element of document.querySelectorAll('[required]')) {
        const v = element.value;
        if (!v && v !== 0) {
            return false;
        }
    }
    return true;
}

export function requiredAns(v) {
    for (const k in v) {
        const e = v[k];
        if ((e.option !== null && e.option !== {}) && !e.answer) {
            return false;
        }
    }
    return true;
}
