document.addEventListener('DOMContentLoaded', () => {
  const startButton = document.getElementById('start-quiz');
  const quizContainer = document.getElementById('quiz-container');
  const progressBar = document.getElementById('quiz-progress');
  const resultBox = document.getElementById('quiz-result');

  let currentQuestionIndex = 0;
  let correctAnswersCount = 0;
  let questions = [];

  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
  }

  function updateProgress(index) {
    const percent = Math.round(((index + 1) / questions.length) * 100);
    progressBar.style.width = `${percent}%`;
    progressBar.textContent = `${percent}%`;
    progressBar.setAttribute('aria-valuenow', percent);
  }

  function resetProgress() {
    progressBar.style.width = '0%';
    progressBar.textContent = '0%';
    progressBar.setAttribute('aria-valuenow', 0);
  }

  function resetResults() {
    correctAnswersCount = 0;
    resultBox.style.display = 'none';
    resultBox.innerHTML = '';
  }

  function renderQuestion(index) {
    const question = questions[index];
    quizContainer.innerHTML = '';

    const card = document.createElement('div');
    card.className = 'card mb-3';

    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';

    const title = document.createElement('h5');
    title.className = 'card-title';
    title.textContent = `Frage ${index + 1}`;

    const questionText = document.createElement('p');
    questionText.className = 'card-text';
    questionText.textContent = question.text;

    cardBody.appendChild(title);
    cardBody.appendChild(questionText);

    const answerContainer = document.createElement('div');
    answerContainer.className = 'mt-2';

    question.answers.forEach(answer => {
      const answerBtn = document.createElement('button');
      answerBtn.className = 'btn btn-outline-primary m-1';
      answerBtn.textContent = answer.text;

      answerBtn.addEventListener('click', () => {
        const allButtons = answerContainer.querySelectorAll('button');
        allButtons.forEach(btn => {
          btn.disabled = true;
          btn.classList.remove('btn-outline-primary');
        });

        if (answer.is_correct) {
          answerBtn.classList.add('btn-success');
          correctAnswersCount++;
        } else {
          answerBtn.classList.add('btn-danger');
        }

        nextBtn.style.display = 'inline-block';

        // ➕ ERKLÄRUNGSBUTTON EINBLENDEN
        if (question.explanation) {
          const showExplanationBtn = document.createElement('button');
          showExplanationBtn.className = 'btn btn-outline-info mt-2 ms-1';
          showExplanationBtn.textContent = '🛈 Hintergrund anzeigen';

          const explanationBox = document.createElement('div');
          explanationBox.className = 'mt-2 p-2 border rounded explanation-text';
          explanationBox.style.display = 'none';
          explanationBox.style.backgroundColor = '#eef5f9';
          explanationBox.style.borderLeft = '4px solid #17a2b8';

          const explanationText = document.createElement('p');
          explanationText.textContent = question.explanation;
          explanationBox.appendChild(explanationText);

          showExplanationBtn.addEventListener('click', () => {
            explanationBox.style.display = explanationBox.style.display === 'none' ? 'block' : 'none';
            showExplanationBtn.textContent = explanationBox.style.display === 'block'
              ? '🛈 Hintergrund ausblenden'
              : '🛈 Hintergrund anzeigen';
          });

          cardBody.appendChild(showExplanationBtn);
          cardBody.appendChild(explanationBox);
        }
      });

      answerContainer.appendChild(answerBtn);
    });

    cardBody.appendChild(answerContainer);

    const nextBtn = document.createElement('button');
    nextBtn.textContent = 'Weiter';
    nextBtn.className = 'btn btn-secondary mt-3';
    nextBtn.style.display = 'none';

    nextBtn.addEventListener('click', () => {
      currentQuestionIndex++;
      if (currentQuestionIndex < questions.length) {
        renderQuestion(currentQuestionIndex);
      } else {
        quizContainer.innerHTML = '';
        resultBox.style.display = 'block';
        resultBox.innerHTML = `
          🎉 Du hast das Quiz abgeschlossen!<br>
          ✅ ${correctAnswersCount} von ${questions.length} Antworten waren korrekt.
        `;
        startButton.textContent = 'Quiz erneut starten';
        startButton.disabled = false;
        resetProgress();
      }
    });

    cardBody.appendChild(nextBtn);
    card.appendChild(cardBody);
    quizContainer.appendChild(card);

    updateProgress(index);

    const controlBar = document.createElement('div');
    controlBar.className = 'mt-4';

    const restartBtn = document.createElement('button');
    restartBtn.className = 'btn btn-warning me-2';
    restartBtn.textContent = 'Quiz neustarten';
    restartBtn.addEventListener('click', () => {
      shuffleArray(questions);
      currentQuestionIndex = 0;
      resetProgress();
      resetResults();
      renderQuestion(currentQuestionIndex);
    });

    const abortBtn = document.createElement('button');
    abortBtn.className = 'btn btn-outline-danger';
    abortBtn.textContent = 'Quiz abbrechen';
    abortBtn.addEventListener('click', () => {
      resetProgress();
      resetResults();
      quizContainer.innerHTML = '<div class="alert alert-secondary">⛔ Quiz wurde abgebrochen.</div>';
      startButton.disabled = false;
      startButton.textContent = 'Quiz neu starten';
    });

    controlBar.appendChild(restartBtn);
    controlBar.appendChild(abortBtn);
    quizContainer.appendChild(controlBar);
  }

  startButton.addEventListener('click', async () => {
    startButton.disabled = true;
    startButton.textContent = 'Lade Fragen...';
    quizContainer.innerHTML = '';
    resetProgress();
    resetResults();

    try {
      const response = await fetch('/test/cybermobbing/quiz/get-questions.php');
      if (!response.ok) throw new Error(`HTTP-Fehler: ${response.status}`);

      const text = await response.text();
      const data = JSON.parse(text);

      if (Array.isArray(data.questions)) {
        questions = data.questions;
        shuffleArray(questions);
        currentQuestionIndex = 0;
        renderQuestion(currentQuestionIndex);
      } else {
        quizContainer.innerHTML = '<div class="alert alert-warning">⚠️ Keine Fragen gefunden.</div>';
        startButton.disabled = false;
        startButton.textContent = 'Quiz neu starten';
        resetProgress();
      }
    } catch (error) {
      console.error('Fehler beim Laden der Fragen:', error);
      quizContainer.innerHTML = '<div class="alert alert-danger">❌ Fehler beim Laden der Fragen.</div>';
      startButton.disabled = false;
      startButton.textContent = 'Quiz neu starten';
      resetProgress();
    }
  });
});