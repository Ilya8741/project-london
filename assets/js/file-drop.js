(function () {
  if (window.__fileDropBound) return;
  window.__fileDropBound = true;

  function fmtMB(bytes) {
    return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
  }

  function ensureMeta(wrap) {
    let meta = wrap.querySelector('.file-drop__meta');
    if (!meta) {
      meta = document.createElement('div');
      meta.className = 'file-drop__meta';
      meta.setAttribute('aria-live', 'polite');
      wrap.appendChild(meta);
    }
    return meta;
  }

  function forcePaintFrom(el) {
    // ищем ближайший диалог модалки и "пинаем" его для перерисовки
    const dialog = el.closest('.team-modal__dialog') || el.closest('.team-modal') || document.body;
    const prev = dialog.style.transform;
    dialog.style.willChange = 'transform';
    dialog.style.transform = 'translateZ(0)';   // задействуем композитинг
    // reflow
    void dialog.offsetHeight;
    // возвращаем
    dialog.style.transform = prev || '';
    dialog.style.willChange = '';
  }

  function renderFileMeta(wrap, file) {
    if (!wrap) return;
    const meta = ensureMeta(wrap);
    const labelText = wrap.querySelector('.file-drop__text');

    if (file) {
      const name = file.name || '';
      const size = Number.isFinite(file.size) ? fmtMB(file.size) : '';
      const out  = size ? (name + ' • ' + size) : name;

      // ставим текст
      meta.textContent = out;
      wrap.classList.add('has-file');
      if (labelText) labelText.style.visibility = 'hidden';

      // форсим перерисовку модалки
      forcePaintFrom(meta);

      // на случай гонок — повторим ещё пару раз
      requestAnimationFrame(() => { if (meta.textContent !== out) { meta.textContent = out; forcePaintFrom(meta); } });
      setTimeout(() => { if (meta.textContent !== out) { meta.textContent = out; forcePaintFrom(meta); } }, 60);
    } else {
      meta.textContent = '';
      wrap.classList.remove('has-file');
      if (labelText) labelText.style.visibility = '';
      forcePaintFrom(meta);
    }
  }

  function onChangeCapture(e) {
    const input = e.target;
    if (!(input instanceof HTMLInputElement)) return;
    if (input.type !== 'file') return;

    const wrap = input.closest('.file-drop');
    if (!wrap) return;

    if (input.files && input.files.length) {
      renderFileMeta(wrap, input.files[0]);
    } else {
      renderFileMeta(wrap, null);
    }
  }

  function initScope(scope) {
    // первичная чистая инициализация в конкретном контейнере (в т.ч. после монтирования модалки)
    scope.querySelectorAll('.file-drop').forEach((wrap) => {
      // reset по умолчанию
      renderFileMeta(wrap, null);

      // если файл уже выбран (редко, но вдруг), подтянем
      const input = wrap.querySelector('input[type="file"]');
      if (input && input.files && input.files.length) {
        renderFileMeta(wrap, input.files[0]);
      }
    });
  }

  function initGlobal() {
    document.addEventListener('change', onChangeCapture, true);
    document.addEventListener('input',  onChangeCapture, true);

    // стартовая инициализация для всего документа
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => initScope(document));
    } else {
      initScope(document);
    }

    // NEW: инициализация при открытии модалки (наш хук)
    document.addEventListener('team-modal:mounted', (e) => {
      const mount = e.detail?.mount || e.target;
      initScope(mount);
      // небольшой таймер — если чужие скрипты что-то меняют сразу после монтирования
      setTimeout(() => initScope(mount), 30);
    });
  }

  initGlobal();
})();
