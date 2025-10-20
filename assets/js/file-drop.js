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
    const dialog = el.closest('.team-modal__dialog') || el.closest('.team-modal') || document.body;
    const prev = dialog.style.transform;
    dialog.style.willChange = 'transform';
    dialog.style.transform = 'translateZ(0)';  
    void dialog.offsetHeight;
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

      meta.textContent = out;
      wrap.classList.add('has-file');
      if (labelText) labelText.style.visibility = 'hidden';

      forcePaintFrom(meta);

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
    scope.querySelectorAll('.file-drop').forEach((wrap) => {
      renderFileMeta(wrap, null);

      const input = wrap.querySelector('input[type="file"]');
      if (input && input.files && input.files.length) {
        renderFileMeta(wrap, input.files[0]);
      }
    });
  }

  function initGlobal() {
    document.addEventListener('change', onChangeCapture, true);
    document.addEventListener('input',  onChangeCapture, true);

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => initScope(document));
    } else {
      initScope(document);
    }

    document.addEventListener('team-modal:mounted', (e) => {
      const mount = e.detail?.mount || e.target;
      initScope(mount);
      setTimeout(() => initScope(mount), 30);
    });
  }

  initGlobal();
})();
