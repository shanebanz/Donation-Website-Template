(function () {
  const body = document.body;
  if (!body) {
    return;
  }

  const targetId = (body.dataset.skeletonTarget || '').trim();
  if (!targetId) {
    body.classList.remove('skeleton-loading');
    return;
  }

  const targetSkeleton = document.getElementById(targetId);
  if (targetSkeleton) {
    targetSkeleton.classList.add('active');
  }

  const minVisibleMs = 350;

  const finishLoading = function () {
    window.setTimeout(function () {
      body.classList.remove('skeleton-loading');
    }, minVisibleMs);
  };

  if (document.readyState === 'complete') {
    finishLoading();
  } else {
    window.addEventListener('load', finishLoading, { once: true });
  }

  window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
      body.classList.remove('skeleton-loading');
    }
  });

  window.setTimeout(function () {
    body.classList.remove('skeleton-loading');
  }, 4500);
})();
