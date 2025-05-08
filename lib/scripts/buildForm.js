document.addEventListener("DOMContentLoaded", () => {
  if (!document.getElementById("build-form")) {
    return;
  }

  const buildForm = document.getElementById("build-form");
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const processorInput = document.getElementById("processor");
  const ramInput = document.getElementById("ram");
  const motherboardInput = document.getElementById("motherboard");
  const nameError = document.getElementById("name-error");
  const emailError = document.getElementById("email-error");
  const processorError = document.getElementById("processor-error");
  const ramError = document.getElementById("ram-error");
  const motherboardError = document.getElementById("motherboard-error");

  if (
    !buildForm ||
    !nameInput ||
    !emailInput ||
    !processorInput ||
    !ramInput ||
    !motherboardInput
  ) {
    return;
  }

  const validateName = (name) => {
    if (!name) return "El nombre es obligatorio";
    return "";
  };

  const validateEmail = (email) => {
    if (!email) return "El email es obligatorio";
    if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email))
      return "Ingrese un email válido";
    return "";
  };

  const validateSelect = (value, fieldName) => {
    if (!value || value === "") return `Elegí un/a ${fieldName}.`;
    return "";
  };

  const updateError = (input, errorElement, errorMessage) => {
    if (!input || !errorElement) return;
    errorElement.textContent = errorMessage;
    input.classList.toggle("border-red-600", !!errorMessage);
    input.setAttribute("aria-invalid", !!errorMessage);
  };

  const clearErrors = () => {
    updateError(nameInput, nameError, "");
    updateError(emailInput, emailError, "");
    updateError(processorInput, processorError, "");
    updateError(ramInput, ramError, "");
    updateError(motherboardInput, motherboardError, "");
  };

  const validateForm = () => {
    clearErrors();
    let isValid = true;

    const nameErrorMsg = validateName(nameInput.value.trim());
    if (nameErrorMsg) {
      updateError(nameInput, nameError, nameErrorMsg);
      isValid = false;
    }

    const emailErrorMsg = validateEmail(emailInput.value.trim());
    if (emailErrorMsg) {
      updateError(emailInput, emailError, emailErrorMsg);
      isValid = false;
    }

    const processorErrorMsg = validateSelect(
      processorInput.value,
      "procesador"
    );
    if (processorErrorMsg) {
      updateError(processorInput, processorError, processorErrorMsg);
      isValid = false;
    }

    const ramErrorMsg = validateSelect(ramInput.value, "memoria RAM");
    if (ramErrorMsg) {
      updateError(ramInput, ramError, ramErrorMsg);
      isValid = false;
    }

    const motherboardErrorMsg = validateSelect(
      motherboardInput.value,
      "motherboard"
    );
    if (motherboardErrorMsg) {
      updateError(motherboardInput, motherboardError, motherboardErrorMsg);
      isValid = false;
    }

    return isValid;
  };

  nameInput.addEventListener("blur", () => {
    updateError(nameInput, nameError, validateName(nameInput.value.trim()));
  });

  emailInput.addEventListener("blur", () => {
    updateError(emailInput, emailError, validateEmail(emailInput.value.trim()));
  });

  processorInput.addEventListener("change", () => {
    updateError(
      processorInput,
      processorError,
      validateSelect(processorInput.value, "procesador")
    );
  });

  ramInput.addEventListener("change", () => {
    updateError(
      ramInput,
      ramError,
      validateSelect(ramInput.value, "memoria RAM")
    );
  });

  motherboardInput.addEventListener("change", () => {
    updateError(
      motherboardInput,
      motherboardError,
      validateSelect(motherboardInput.value, "motherboard")
    );
  });

  buildForm.addEventListener("submit", (event) => {
    if (!validateForm()) {
      event.preventDefault();
      return;
    }
  });
});
