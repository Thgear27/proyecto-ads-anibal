document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("emitir-cotizacion-form");
  const nextButton = document.getElementById("btnSiguiente");

  nextButton.addEventListener("click", (event) => {
    event.preventDefault();

    // Primero validamos el formulario usando la API de validación nativa de HTML5
    if (!form.checkValidity()) {
      // Si no es válido, mostramos las advertencias de validación
      form.reportValidity();
      return; // No continúa si no pasa la validación
    }

    // Crear un objeto FormData a partir del formulario
    const formData = new FormData(form);

    // Obtener todos los productos seleccionados (checkbox marcados)
    const selectedProducts = [];
    const productCheckboxes = document.querySelectorAll("[data-product-checkbox]:checked");

    productCheckboxes.forEach((checkbox) => {
      const productId = checkbox.getAttribute("data-product-id");
      const productName = checkbox.getAttribute("data-product-name");
      const productPrice = checkbox.getAttribute("data-product-price");

      selectedProducts.push({
        id: productId,
        name: productName,
        price: productPrice,
      });
    });

    // Agregar el array de productos como un campo más en el Formulario (input hidden)
    const productsField = document.createElement("input");
    productsField.type = "hidden";
    productsField.name = "productsArray";
    productsField.value = JSON.stringify(selectedProducts);
    form.appendChild(productsField);

    const btnSiguienteField = document.createElement("input");
    btnSiguienteField.type = "hidden";
    btnSiguienteField.name = "btnSiguiente";
    btnSiguienteField.value = "siguiente";
    form.appendChild(btnSiguienteField);

    // Enviar el formulario
    form.submit();
  });
});
