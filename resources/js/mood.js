
  const toggleBtn = document.getElementById("theme-toggle");
  const body = document.body;

  // Vérifie si le thème est sauvegardé dans le cookie
  if (document.cookie.includes("theme=dark")) {
    body.classList.add("dark");
    toggleBtn.textContent = "☀️";
  }

  toggleBtn.addEventListener("click", () => {
    body.classList.toggle("dark");
    const newTheme = body.classList.contains("dark") ? "dark" : "light";
    toggleBtn.textContent = newTheme === "dark" ? "☀️" : "🌙";

    // Sauvegarde du thème dans un cookie (valable 30 jours)
    document.cookie = "theme=" + newTheme + "; path=/; max-age=" + (60 * 60 * 24 * 30);
  });

