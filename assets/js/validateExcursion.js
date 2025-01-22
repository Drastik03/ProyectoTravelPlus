const form = document.getElementById("excursionForm");
const required = [
    "nombre",
    "categoria",
    "fecha_inicio",
    "duracion",
    "precio",
    "descripcion",
    "image"
];

function validateField(field) {
    const group = field.closest(".form-group");
    let isValid = false;

    if (field.tagName === "SELECT") {
        isValid = field.value.trim() !== "" && field.selectedIndex !== 0;
    } else if (field.type === "date") {
        isValid = field.value.trim() !== "" && validateDate(field);
    } else {
        isValid = field.value.trim() !== "";
    }

    group.classList.toggle("error", !isValid);
    return isValid;
}

function validateDate(field) {
    const selectedDate = new Date(field.value);
    const today = new Date();

    today.setHours(0, 0, 0, 0);

    if (selectedDate >= today) {
        return true;
    } else {
        return false;
    }
}

form.addEventListener("submit", (e) => {
    e.preventDefault(); 

    let isValid = true;

    required.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        if (field && !validateField(field)) {
            isValid = false;
        }
    });

    if (isValid) {
        console.log("Formulario válido", Object.fromEntries(new FormData(form)));
        form.submit();  
    } else {
        console.log("Formulario no válido");
    }
});

form.addEventListener("input", (e) => {
    if (required.includes(e.target.id)) {
        validateField(e.target);
    }
});

form.addEventListener("reset", () => {
    document.querySelectorAll(".form-group.error").forEach((group) => {
        group.classList.remove("error");
    });
});
