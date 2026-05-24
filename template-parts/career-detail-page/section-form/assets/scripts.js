export function sectionForm() {
  // ------------------------------------------------------------
  // Validation rules
  function validateFullName(name) {
    // First, trim the input
    const trimmedName = name ? name.trim() : "";

    // Check if empty
    if (!trimmedName) {
      return "Vui lòng nhập họ và tên";
    }

    // Check minimum length
    if (trimmedName.length < 2) {
      return "Họ và tên phải có ít nhất 2 ký tự";
    }

    // Check for valid Vietnamese characters, spaces, and common name separators
    const nameRegex = /^[\p{L}\s'-]+$/u;

    if (!nameRegex.test(trimmedName)) {
      return "Họ và tên chỉ được chứa chữ cái và khoảng trắng";
    }

    return null; // No error
  }

  function validatePhone(phone) {
    if (!phone || phone.trim().length === 0) {
      return "Vui lòng nhập số điện thoại";
    }

    const cleanPhone = phone.replace(/\D/g, "");
    if (cleanPhone.length < 10 || cleanPhone.length > 11) {
      return "Số điện thoại phải có 10-11 chữ số";
    }

    if (!/^(0[3|5|7|8|9])[0-9]{8}$/.test(cleanPhone)) {
      return "Số điện thoại không đúng định dạng Việt Nam";
    }

    return null;
  }

  function validateEmail(email) {
    if (!email || email.trim().length === 0) {
      return "Vui lòng nhập email";
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.trim())) {
      return "Email không đúng định dạng";
    }

    return null;
  }

  function validateCvFile(fileInput) {
    const file = fileInput?.files?.[0];
    if (!file) {
      return "Vui lòng tải CV của bạn lên";
    }

    const maxSizeBytes = 10 * 1024 * 1024;
    if (file.size > maxSizeBytes) {
      return "File CV vượt quá dung lượng cho phép (10MB)";
    }

    return null;
  }

  // ------------------------------------------------------------
  // Error handling helpers
  function showError(fieldName, message, form) {
    const errorElement = form.querySelector(`#${fieldName}Error`);
    const inputElement = form.querySelector(`[name="${fieldName}"]`);
    const fieldWrapper =
      inputElement?.closest(".contact__field") ||
      inputElement?.closest(".form-field") ||
      inputElement?.closest(".career-form__field") ||
      inputElement?.closest(".career-form__field-wrapper");

    if (!errorElement && fieldName === "career_cv") {
      const uploadWrapper =
        inputElement?.closest(".career-form__upload") ||
        form.querySelector(".career-form__upload");
      if (uploadWrapper) {
        let dynamicError = uploadWrapper.querySelector(
          '[data-error-for="career_cv"]'
        );
        if (!dynamicError) {
          dynamicError = document.createElement("div");
          dynamicError.setAttribute("data-error-for", "career_cv");
          dynamicError.className = "career-form__field-error";
          uploadWrapper.appendChild(dynamicError);
        }
        dynamicError.textContent = message;
        dynamicError.classList.add("show");
        uploadWrapper.classList.add("error");
      }
      return;
    }

    if (errorElement) {
      errorElement.textContent = message;
      errorElement.classList.add("show");
    }

    if (fieldWrapper) {
      fieldWrapper.classList.add("error");
    }
  }

  function clearError(fieldName, form) {
    const errorElement = form.querySelector(`#${fieldName}Error`);
    const inputElement = form.querySelector(`[name="${fieldName}"]`);
    const fieldWrapper =
      inputElement?.closest(".contact__field") ||
      inputElement?.closest(".form-field") ||
      inputElement?.closest(".career-form__field") ||
      inputElement?.closest(".career-form__field-wrapper");

    if (!errorElement && fieldName === "career_cv") {
      const uploadWrapper =
        inputElement?.closest(".career-form__upload") ||
        form.querySelector(".career-form__upload");
      const dynamicError = uploadWrapper?.querySelector(
        '[data-error-for="career_cv"]'
      );
      if (dynamicError) {
        dynamicError.textContent = "";
        dynamicError.classList.remove("show");
      }
      if (uploadWrapper) {
        uploadWrapper.classList.remove("error");
      }
      return;
    }

    if (errorElement) {
      errorElement.textContent = "";
      errorElement.classList.remove("show");
    }

    if (fieldWrapper) {
      fieldWrapper.classList.remove("error");
    }
  }

  // ------------------------------------------------------------
  // Form validation entrypoint
  function validateForm(form) {
    let isValid = true;

    const fullName = form.querySelector('[name="fullName"]')?.value || "";
    const phone = form.querySelector('[name="phone"]')?.value || "";
    const email = form.querySelector('[name="email"]')?.value || "";
    const cvInput = form.querySelector('[name="career_cv"]');

    // Clear all errors first
    clearError("fullName", form);
    clearError("phone", form);
    clearError("email", form);
    clearError("career_cv", form);

    // Validate fields
    const fullNameError = validateFullName(fullName);
    if (fullNameError) {
      showError("fullName", fullNameError, form);
      isValid = false;
    }

    const phoneError = validatePhone(phone);
    if (phoneError) {
      showError("phone", phoneError, form);
      isValid = false;
    }

    const emailError = validateEmail(email);
    if (emailError) {
      showError("email", emailError, form);
      isValid = false;
    }

    const cvError = validateCvFile(cvInput);
    if (cvError) {
      showError("career_cv", cvError, form);
      isValid = false;
    }

    return isValid;
  }

  // ------------------------------------------------------------
  // Helpers
  function getFormData(form) {
    const formData = new FormData(form);

    const rawPhone = form.querySelector('[name="phone"]')?.value || "";
    formData.set("phone", rawPhone.replace(/\D/g, ""));
    formData.set(
      "fullName",
      form.querySelector('[name="fullName"]')?.value.trim() || ""
    );
    formData.set(
      "email",
      form.querySelector('[name="email"]')?.value.trim() || ""
    );
    formData.append("timestamp", new Date().toISOString());

    return formData;
  }

  function resetForm(form) {
    form.reset();
    // Clear any remaining error states
    ["fullName", "phone", "email", "career_cv"].forEach((field) => {
      clearError(field, form);
    });
    
    // Reset upload text
    const uploadText = form.querySelector(".career-form__upload-text");

    if (uploadText) {
      uploadText.textContent = "Tải CV của bạn lên";
    }
  }

  // ------------------------------------------------------------
  // Main form initialization
  function initFormValidation() {
    const forms = document.querySelectorAll(
      "#careerForm, .career-form__form, #contactForm, .contact-form"
    );

    forms.forEach((form, formIndex) => {
      const submitButton = form.querySelector(
        ".career-form__submit-btn, .contact__submit-btn, .submit-btn"
      );
      const submitButtonText = submitButton?.querySelector(
        ".career-form__submit-btn-text, .contact__submit-btn-text, .submit-btn-text"
      );
      const originalSubmitButtonText = submitButtonText?.textContent;

      form.addEventListener("submit", (e) => {
        e.preventDefault();

        if (validateForm(form)) {
          if (submitButton) submitButton.disabled = true;
          if (submitButtonText) {
            submitButtonText.textContent = "Đang xử lý...";
          }

          const formData = getFormData(form);
          console.log(`Form ${formIndex + 1} data ready for API:`, formData);

          const cf7Request = new CF7Request(formData);
          cf7Request
            .send({
              id: 1108,
              unitTag: "af6bee9",
            })
            .then((response) => {
              console.log(`Form ${formIndex + 1} CF7 Success:`, response);
              if (typeof toastNotification !== "undefined") {
                toastNotification.success(
                  "Ứng tuyển thành công!",
                  "Cảm ơn bạn đã ứng tuyển. Chúng tôi sẽ xem xét hồ sơ và liên hệ với bạn sớm nhất.",
                  6000
                );
              }
              resetForm(form);
            })
            .catch((error) => {
              console.error(`Form ${formIndex + 1} CF7 Error:`, error);
              if (typeof toastNotification !== "undefined") {
                toastNotification.error(
                  "Ứng tuyển thất bại!",
                  "Có lỗi xảy ra khi gửi hồ sơ ứng tuyển. Vui lòng thử lại.",
                  6000
                );
              }
            })
            .finally(() => {
              if (submitButton) submitButton.disabled = false;
              if (submitButtonText) {
                submitButtonText.textContent =
                  originalSubmitButtonText || "Ứng tuyển ngay";
              }
            });
        }
      });

      // Real-time validation bindings
      const fullNameInput = form.querySelector('[name="fullName"]');
      const phoneInput = form.querySelector('[name="phone"]');
      const emailInput = form.querySelector('[name="email"]');
      const cvInput = form.querySelector('[name="career_cv"]');

      // Helper function to handle input validation
      const setupInputValidation = (input, validator, fieldName) => {
        if (!input) return;

        // Validate on blur
        input.addEventListener("blur", () => {
          const error = validator(input.value);
          if (error) {
            showError(fieldName, error, form);
          } else {
            clearError(fieldName, form);
          }
        });

        // Clear error on input
        input.addEventListener("input", () => {
          if (input.value.trim().length > 0) {
            clearError(fieldName, form);
          }
        });
      };

      // Set up validation for each field
      setupInputValidation(fullNameInput, validateFullName, "fullName");
      setupInputValidation(phoneInput, validatePhone, "phone");
      setupInputValidation(emailInput, validateEmail, "email");

      if (cvInput) {
        cvInput.addEventListener("change", () => {
          const error = validateCvFile(cvInput);
          if (error) {
            showError("career_cv", error, form);
          } else {
            clearError("career_cv", form);
          }

          const uploadText =
            cvInput.closest(".career-form__upload")?.querySelector(
              ".career-form__upload-text"
            ) || form.querySelector(".career-form__upload-text");
          if (uploadText) {
            uploadText.textContent = cvInput.files?.[0]?.name || "Tải CV của bạn lên";
          }
        });
      }
    });
  }

  // ------------------------------------------------------------
  // Initialize contact form
  initFormValidation();
}