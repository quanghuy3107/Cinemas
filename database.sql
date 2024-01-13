use cinemas;
create table role(
	role_Id bigint not null primary key auto_increment,
    role_name varchar(50),
    role_code varchar(50)
);

create table room_status(
	room_status_Id bigint not null primary key auto_increment,
    room_status_name varchar(50)
);

create table user(
	user_Id bigint not null primary key auto_increment,
    name varchar(255),
    email varchar(100),
    username varchar(100),
    password varchar(100),
    user_status varchar(50) DEFAULT 'active',
    role_Id bigint
);
ALTER TABLE user ADD FOREIGN KEY (role_Id) REFERENCES role(role_Id);

create table category(
	category_Id bigint not null primary key auto_increment,
    category_name varchar(100)
); 

create table movie(
	movie_Id bigint not null primary key auto_increment,
    movie_name varchar(255),
    director varchar(100),
    performers varchar(255),
    movie_duration int,
    start_date date,
    end_date date,
    describe_movie text,
    image varchar(255),
    category_Id bigint
);

ALTER TABLE movie ADD FOREIGN KEY (category_Id) REFERENCES category(category_Id);

create table genre(
	genre_Id bigint not null primary key auto_increment,
    genre_name varchar(100)
);

create table movie_genre_detail(
	movie_genre_detail_Id bigint not null primary key auto_increment,
    genre_Id bigint,
    movie_Id bigint
);

ALTER TABLE movie_genre_detail ADD FOREIGN KEY (genre_Id) REFERENCES genre(genre_Id);
ALTER TABLE movie_genre_detail ADD FOREIGN KEY (movie_Id) REFERENCES movie(movie_Id);


create table room(
	room_Id bigint not null primary key auto_increment,
    room_code varchar(255),
    room_status_Id bigint
);
ALTER TABLE room ADD FOREIGN KEY (room_status_Id) REFERENCES room_status(room_status_Id);

create table showtime(
	showtime_Id bigint not null primary key auto_increment,
    price double, 
    movie_Id bigint,
    room_Id bigint,
    showtime timestamp
);
ALTER TABLE showtime ADD FOREIGN KEY (movie_Id) REFERENCES movie(movie_Id);
ALTER TABLE showtime ADD FOREIGN KEY (room_Id) REFERENCES room(room_Id);

create table row_of_seat(
	row_of_seat_Id bigint not null primary key auto_increment,
    row_code varchar(20),
    number_of_seat int,
    room_Id bigint,
    showtime_Id bigint
);
ALTER TABLE row_of_seat ADD FOREIGN KEY (showtime_Id) REFERENCES showtime(showtime_Id);
ALTER TABLE row_of_seat ADD FOREIGN KEY (room_Id) REFERENCES room(room_Id);

create table seat(
	seat_Id bigint not null primary key auto_increment,
    seat_code varchar(50),
    row_of_seat_Id bigint,
    seat_status  enum('available','reserved','booked') DEFAULT 'available'
);
ALTER TABLE seat ADD FOREIGN KEY (row_of_seat_Id) REFERENCES row_of_seat(row_of_seat_Id);

create table comment(
	comment_Id bigint not null primary key auto_increment,
    user_Id bigint,
    movie_Id bigint,
    content text,
    data_of_comment timestamp
);
ALTER TABLE comment ADD FOREIGN KEY (user_Id) REFERENCES user(user_Id);
ALTER TABLE comment ADD FOREIGN KEY (movie_Id) REFERENCES movie(movie_Id);

create table order_user(
	order_Id bigint not null primary key auto_increment,
    order_code int,
    seat_booked varchar(255),
    order_time timestamp,
    quantity int,
    total_money double,
    user_Id bigint,
    showtime_Id bigint
);
ALTER TABLE order_user ADD FOREIGN KEY (showtime_Id) REFERENCES showtime(showtime_Id);
ALTER TABLE order_user ADD FOREIGN KEY (user_Id) REFERENCES user(user_Id);


create table revenue(
	revenue_Id bigint not null primary key auto_increment,
    date timestamp,
    price double
);

create table detail_revenue(
	detail_revenue_id bigint not null primary key auto_increment,
    revenue_Id bigint,
    movie_Id bigint
);
ALTER TABLE detail_revenue ADD FOREIGN KEY (revenue_Id) REFERENCES revenue(revenue_Id);
ALTER TABLE detail_revenue ADD FOREIGN KEY (movie_Id) REFERENCES movie(movie_Id);
