document.addEventListener('DOMContentLoaded', function () {
    function createAnimatedLine(x1, y1, x2, y2) {
      const svg = document.getElementById('animated-lines');
      const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      path.setAttribute('stroke', '#FAAF3C');
      path.setAttribute('stroke-width', '2');
      path.setAttribute('stroke-dasharray', '5 5');
      path.setAttribute('fill', 'none');
  
      const controlX = (x1 + x2) / 2 + (Math.random() - 0.5) * 200;
      const controlY = (y1 + y2) / 2 + (Math.random() - 0.5) * 200;
      const pathData = `M${x1},${y1} Q${controlX},${controlY} ${x2},${y2}`;
      path.setAttribute('d', pathData);
      svg.appendChild(path);
  
      const startDot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
      startDot.setAttribute('cx', x1);
      startDot.setAttribute('cy', y1);
      startDot.setAttribute('r', '4');
      startDot.setAttribute('fill', '#FAAF3C');
      svg.appendChild(startDot);
  
      const endDot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
      endDot.setAttribute('cx', x2);
      endDot.setAttribute('cy', y2);
      endDot.setAttribute('r', '4');
      endDot.setAttribute('fill', '#FAAF3C');
      svg.appendChild(endDot);
  
      let phase = 0;
      function animateLine() {
        phase += 0.01;
        const newPathData = `M${x1},${y1} Q${controlX + Math.sin(phase) * 20},${controlY + Math.cos(phase) * 20} ${x2},${y2}`;
        path.setAttribute('d', newPathData);
        requestAnimationFrame(animateLine);
      }
  
      animateLine();
    }
  
    for (let i = 0; i < 5; i++) {
      const x1 = Math.random() < 0.5 ? -100 : window.innerWidth + 100;
      const y1 = Math.random() * window.innerHeight;
      const x2 = Math.random() * window.innerWidth;
      const y2 = Math.random() * window.innerHeight;
      createAnimatedLine(x1, y1, x2, y2);
    }
  });
  