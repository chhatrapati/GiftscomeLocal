ALTER TABLE tbl_userbids
ADD FOREIGN KEY (game_id)
REFERENCES tbl_game (id)
ON DELETE CASCADE


CREATE TABLE rooms (
    room_no INT PRIMARY KEY AUTO_INCREMENT,
    room_name VARCHAR(255) NOT NULL,
    building_no INT NOT NULL,
    FOREIGN KEY (building_no)
        REFERENCES buildings (building_no)
        ON DELETE CASCADE
);