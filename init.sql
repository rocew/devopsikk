CREATE TABLE polls (
    id SERIAL PRIMARY KEY,
    question TEXT NOT NULL
);

CREATE TABLE options (
    id SERIAL PRIMARY KEY,
    poll_id INTEGER REFERENCES polls(id) ON DELETE CASCADE,
    option_text TEXT NOT NULL,
    votes INTEGER DEFAULT 0
);
