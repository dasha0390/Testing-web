export const config = {
  schedule: '0 * * * *',
};

export const handler = async () => {
  const hook = process.env.BUILD_HOOK_URL;

  if (!hook) {
    console.log('BUILD_HOOK_URL belum diatur, build tidak dipicu.');
    return { statusCode: 200, body: 'skipped: BUILD_HOOK_URL kosong' };
  }

  try {
    const res = await fetch(hook, { method: 'POST' });
    console.log(`Build hook dipicu, status ${res.status}`);
    return { statusCode: 200, body: `triggered: ${res.status}` };
  } catch (err) {
    console.error('Gagal memicu build hook:', err.message);
    return { statusCode: 500, body: 'error' };
  }
};
