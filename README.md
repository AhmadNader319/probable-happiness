# Flask Todo API

This is a simple Flask-based Todo REST API with CORS enabled and Gunicorn-ready.

## Setup

```bash
# Create virtual env
python3 -m venv venv
source venv/bin/activate

# Install dependencies
pip install -r requirements.txt

# Run locally
python app.py

# Or with gunicorn
gunicorn app:app
