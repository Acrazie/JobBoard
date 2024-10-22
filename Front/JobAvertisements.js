document
  .getElementById("applicationForm")
  .addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    try {
      const response = await fetch("../php/apply.php", {
        method: "POST",
        body: formData,
      });

      if (response.ok) {
        alert("La candidature a été soumis avec succès.");
      } else {
        alert(
          "Il y'a eu un problème lors de la soumission de votre candidature."
        );
      }
    } catch (error) {
      console.error("Erreur:", error);
      alert("Echec de la soumission de la candidature.");
    }
  });
